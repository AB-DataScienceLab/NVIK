import pandas as pd
import plotly.graph_objects as go
import numpy as np
import colorsys

def create_circular_bar_plot(
    properties_file,
    connections_file,
    ring_colors=None,
    aliphatic_color='#4daf4a',
    cyclic_color='#377eb8'
):
    # Read input files
    df_properties = pd.read_csv(properties_file)
    df_connections = pd.read_csv(connections_file)

    # List of properties
    properties = [
        'Aliphatic or Cyclic',
        'Molecular Weight',
        'HB Acceptors',
        'HB Donors',
        'Rotatable Bonds',
        'LogP',
        'TPSA'
    ]

    # Default color generation if not provided
    if ring_colors is None:
        def generate_distinct_colors(n):
            hue_partition = 1.0 / (n + 1)
            return [
                f'rgb({int(r*255)},{int(g*255)},{int(b*255)})'
                for r, g, b in [colorsys.hsv_to_rgb(hue_partition * i, 0.7, 0.9) for i in range(n)]
            ]
        ring_colors = generate_distinct_colors(len(properties))

    # Normalize the numerical data with special handling for LogP
    numerical_properties = properties[1:]
    df_norm = pd.DataFrame()

    for prop in numerical_properties:
        if prop == 'LogP':
            # Special normalization for LogP to range [-1, 1]
            max_abs_logp = max(abs(df_properties[prop].min()), abs(df_properties[prop].max()))
            df_norm[prop] = df_properties[prop] / max_abs_logp
        else:
            # Standard normalization for other properties to range [0, 1]
            df_norm[prop] = (df_properties[prop] - df_properties[prop].min()) / (df_properties[prop].max() - df_properties[prop].min())

    fig = go.Figure()

    n_compounds = len(df_properties)
    ring_height = 0.08
    ring_gap = 0.04
    max_radius = 0.95

    # Create rings for each property
    for i, prop in enumerate(properties):
        base_radius = max_radius - i * (ring_height + ring_gap)

        if prop == 'Aliphatic or Cyclic':
            fig.add_trace(go.Barpolar(
                r=[0.05 if x == 'Aliphatic' else 0 for x in df_properties[prop]],
                theta=np.linspace(0, 360, n_compounds, endpoint=False),
                width=360 / n_compounds,
                marker_color=aliphatic_color,
                name='Aliphatic',
                hoverinfo='text',
                hovertext=[f"{prop}: {value}" for value in df_properties[prop] if value == 'Aliphatic'],
                base=base_radius
            ))
            fig.add_trace(go.Barpolar(
                r=[0.05 if x == 'Cyclic' else 0 for x in df_properties[prop]],
                theta=np.linspace(0, 360, n_compounds, endpoint=False),
                width=360 / n_compounds,
                marker_color=cyclic_color,
                name='Cyclic',
                hoverinfo='text',
                hovertext=[f"{prop}: {value}" for value in df_properties[prop] if value == 'Cyclic'],
                base=base_radius
            ))
        elif prop == 'LogP':
            logp_values = df_norm[prop] * ring_height
            fig.add_trace(go.Barpolar(
                r=abs(logp_values),
                theta=np.linspace(0, 360, n_compounds, endpoint=False),
                width=360 / n_compounds,
                marker_color=ring_colors[i],
                name=prop,
                hoverinfo='text',
                hovertext=[f"{prop}: {value:.2f}" for value in df_properties[prop]],
                base=[base_radius if val >= 0 else base_radius - abs(val) for val in logp_values]
            ))
        else:
            fig.add_trace(go.Barpolar(
                r=df_norm[prop] * ring_height,
                theta=np.linspace(0, 360, n_compounds, endpoint=False),
                width=360 / n_compounds,
                marker_color=ring_colors[i],
                name=prop,
                hoverinfo='text',
                hovertext=[f"{prop}: {value:.2f}" for value in df_properties[prop]],
                base=base_radius
            ))

    # Create compound ID to angle mapping
    angles = np.linspace(0, 2 * np.pi, n_compounds, endpoint=False)
    id_mapping = {
        row['nvic id']: {'angle': angles[idx], 'index': idx, 'tpsa': df_norm['TPSA'].iloc[idx]}
        for idx, (_, row) in enumerate(df_properties.iterrows())
    }

    # Define the TPSA base radius as the reference
    tpsa_base_radius = max_radius - (len(properties) - 1) * (ring_height + ring_gap)

    # Connection path definition
    def create_connection_path(angle1, angle2, base_radius, connection_idx, total_connections, inward_shift=0.15, num_points=50):
        angle1 = angle1 % (2 * np.pi)
        angle2 = angle2 % (2 * np.pi)

        delta_angle = (angle2 - angle1 + np.pi) % (2 * np.pi) - np.pi
        abs_delta = abs(delta_angle)
        connection_offset = (connection_idx / total_connections) * 0.1

        if abs_delta > np.pi * 0.95:
            mid_angle = (angle1 + angle2) / 2
            t = np.linspace(0, 1, num_points)
            mid_radius = base_radius - inward_shift - connection_offset * 0.5
            radii = np.linspace(base_radius, mid_radius, num_points // 2).tolist() + \
                    np.linspace(mid_radius, base_radius, num_points // 2).tolist()
            angles = np.linspace(angle1, angle2, num_points)
        else:
            t = np.linspace(0, 1, num_points)
            cp_angle = (angle1 + angle2) / 2 + connection_offset
            cp_radius = base_radius - inward_shift - abs_delta * 0.1 - connection_offset * 0.5
            angles = ((1 - t)**2 * angle1 + 2 * (1 - t) * t * cp_angle + t**2 * angle2)
            radii = ((1 - t)**2 * base_radius + 2 * (1 - t) * t * cp_radius + t**2 * base_radius)

        return np.array(angles), np.array(radii)

    # Add connection lines with uniform dark green color
    connection_color = '#006400'  # Dark green
    from collections import defaultdict
    connection_index = defaultdict(int)
    
    for group in df_connections.itertuples():
        id1, id2 = group.id1, group.id2
        if id1 in id_mapping and id2 in id_mapping:
            point1 = id_mapping[id1]
            point2 = id_mapping[id2]
            conn_idx = connection_index[(id1, id2)]
            connection_index[(id1, id2)] += 1

            angles, radii = create_connection_path(
                point1['angle'],
                point2['angle'],
                tpsa_base_radius,
                conn_idx,
                total_connections=len(df_connections)
            )

            fig.add_trace(go.Scatterpolar(
                r=radii,
                theta=np.degrees(angles),
                mode='lines',
                line=dict(color=connection_color, width=0.2),
                showlegend=False,
                hoverinfo='skip'
            ))

    # Update layout
    fig.update_layout(
        polar=dict(
            radialaxis=dict(visible=False, range=[0, 1.3]),
            angularaxis=dict(visible=False, direction='clockwise', rotation=0),
            bgcolor='white'
        ),
        paper_bgcolor='white',
        plot_bgcolor='white',
        showlegend=True,
        legend=dict(
            font=dict(size=24),
            orientation="h",
            yanchor="bottom",
            y=-0.2,
            xanchor="center",
            x=0.5
        ),
        title='Circular Visualization of NVIs Physicochemical Properties',
        height=1200,
        width=1200,
    )

    return fig

def save_plot(
    properties_file,
    connections_file,
    output_file,
    ring_colors=None,
    aliphatic_color='#003049',
    cyclic_color='#52b788'
):
    fig = create_circular_bar_plot(
        properties_file,
        connections_file,
        ring_colors,
        aliphatic_color,
        cyclic_color
    )
    fig.write_image(output_file, scale=10)

# Example usage
if __name__ == "__main__":
    custom_ring_colors = [
        '#FF6B6B',  # Aliphatic/Cyclic
        '#fd7f6f',  # Molecular Weight
        '#7eb0d5',  # HB Acceptors
        '#b2e061',  # HB Donors
        '#bd7ebe',  # Rotatable Bonds
        '#ffb55a',  # LogP
        '#ffee65'   # TPSA
    ]

    save_plot(
        'nvik_indexed_calculated_properties.csv',
        'Jarp_cluster_unique.csv',
        'nvik-properties_plot_final.png',
        ring_colors=custom_ring_colors,
        aliphatic_color='#003049',
        cyclic_color='#52b788'
    )
    
#The above code was partially generated by Claude, an AI assistant created by Anthropic.
#It has been modified and verified for use in this project.