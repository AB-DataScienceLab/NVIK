<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		* {
			box-sizing: border-box;
		}


		body {
			font-family: Arial, Helvetica, sans-serif;
			height: 100%;
		}

		/* Style the header */
		header {
			float: left;
			width: 100%;
			padding: 0px;
			text-align: left;
			font-size: 20px;
			color: #3E6990;
		}

		/* Create two columns/boxes that floats next to each other */
		nav {
			float: right;
			width: 15%;
			height: 635px; /* only for demonstration, should be removed */
			
			padding: 20px;
		}

		/* Style the list inside the menu */
		nav ul {
			list-style-type: none;
			padding: 0;
		}

		article {
			float: left;
			padding: 20px;
			width: 85%;
			color: #818181;
			height: 635px; /* only for demonstration, should be removed */
		}

		/* Clear floats after the columns */
		section:after {
			content: "";
			display: table;
			clear: both;
		}

		/* Style the footer */
		footer {
			position: fixed;
			padding: 8px;
			text-align: center;
			color: white;
		}

		/* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
		@media (max-width: 600px) {
			nav, article {
				width: 100%;
				height: 100%;
			}
		}

		####################menu circular####################################################
		body {
		  font-family: Alegreya Sans;
		  background: #feeded;
		}
		.menu {  /*menu button position inner circle*/
		  position: absolute;
		  background: #dee0e2; 
		  width: 5.5em;
		  height: 5.5em;
		  border-radius: 6em;
		  margin: auto;
		  margin-top: 10em;
		  margin-bottom: 1em;
		  left: 4em;
		  cursor: pointer;
		  border: 1em solid #6c7298;
		}
		.menu:after { /*menu lines  position*/
		  content: "";
		  position: absolute;
		  top: 1.3em;
		  left: 0.5em;
		  width: 1.5em;
		  height: 0.2em;
		  content: "Menu";
		 /* border-top: 0.6em double #fff;
		  border-bottom: 0.2em solid #fff;*/
		}
		.menu ul {
		  list-style: none;
		  padding: 0;
		}
		.menu li {  /*menu bars length and breath */
		  width: 8em;
		  height: 2em;
		  padding: 0.3em;
		  margin-top: -0.5em;
		  text-align: center;
		  border-top-right-radius: 1em;
		  border-bottom-right-radius: 0.5em;
		  transition: all 1s;
		  background: #6c7298;
		  opacity: 0;
		  z-index: -1;
		}
		.menu:hover li {
		  opacity: 1;
		}
		/**
		 * Add a pseudo element to cover the space
		 * between the links. This is so the menu
		 * does not lose :hover focus and disappear
		 */
		.menu:hover ul::before {
		  position: absolute;
		  content: "";
		  width: 0;
		  height: 0;
		  display: block;
		  left: 50%;
		  top: -5.0em;
		  /**
		   * The pseudo-element is a semi-circle
		   * created with CSS. Top, bottom, and right
		   * borders are 6.5em (left being 0), and then
		   * a border-radius is added to the two corners
		   * on the right.
		   */
		  border-width: 6.5em;
		  border-radius: 0 7.5em 7.5em 0;
		  border-left: 0;
		  border-style: solid;
		  /**
		   * Have to have a border color for the border
		   * to be hoverable. I'm using a very light one
		   * so that it looks invisible.
		   */
		  border-color: rgba(0,0,0,0.01);
		  /**
		   * Put the psuedo-element behind the links
		   * (So they can be clicked on)
		   */
		  z-index: -1;
		  /**
		   * Make the cursor default so it looks like
		   * nothing is there
		   */
		  cursor: default;
		}
		.menu a {
		  color: white;
		  text-decoration: none;
		  /**
		   * This is to vertically center the text on the
		   * little tab-like things that the text is on.
		   */
		  line-height: 1.5em;
		}
		.menu a {
		  color: white;
		  text-decoration: none;
		}
		.menu ul {
		  transform: rotate(180deg) translateY(-2em);
		  transition: 1s all;
		}
		.menu:hover ul {
		  transform: rotate(0deg) translateY(-1em);
		}
		.menu li:hover {
		  background: #4F1C12;
		  z-index: 10;
		}

		.menu li:nth-of-type(1) {
		  transform: rotate(-90deg);
		  position: absolute;
		  left: -3.3em;
		  top: -8em;
		}
		.menu li:nth-of-type(2) {
		  transform: rotate(-56deg);
		  position: absolute;
		  left: 2em;
		  top: -6.2em;
		}
		.menu li:nth-of-type(3) {
			transform: rotate(-0deg);
		  position: absolute;
		  left: 5.0em;
		  top: 0.1em;
		}
		.menu li:nth-of-type(4) {
		  transform: rotate(40deg);
		  position: absolute;
		  left: 2.5em;
		  top: 5.9em;
		}
		.menu li:nth-of-type(5) {
		  transform: rotate(90deg);
		  position: absolute;
		  left: -3.5em;
		  top: 8em;
		}
		.menu li:nth-of-type(6) {
		  transform: rotate(90deg);
		  position: absolute;
		  left: -0.4em;
		  top: 8em;
		}
		.hint {
		  text-align: center;
		}
		##############################################architecture###################
		.container {
			position: relative;
			width: 100%;
			max-width: 200px;
			left: 40%;
			padding-top: 20%;
			z-index: -1;	
		}
	</style>
</head>

<body>

	<section>

			<link  rel='stylesheet' type='text/css'>
				<nav class="menu">
				  <ul>
					
					<li><a href="arch.php">Architecture</a></li>
					<li><a href="stats.php">NVIs Stats</a></li>
					<li><a href="physico_chem.php">Properties</a></li>
					<li><a href="priority_inhibitors.php" style="font-size: 15px;">Priority Inhibitors</a></li>
					<li><a href="circos.php">Clustring</a></li>
				  </ul>
				</nav>
			</link>

	</section>
	<!--h3 style="color: blue;padding-top: 310px;padding-left: 80px;">Options</h3 -->
</body>
</html>
