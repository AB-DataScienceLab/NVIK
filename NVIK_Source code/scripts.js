(function () {
    console.log("Script started executing");

    if (typeof jQuery === "undefined") {
        console.error("jQuery is not loaded. Please check your script inclusions.");
        return;
    } else {
        console.log("jQuery is loaded successfully");
    }

    $(document).ready(function () {
        console.log("DOM is ready");

        let fieldIndex = 1;

        if ($("#addFieldButton").length === 0) {
            console.error("Add Field button not found. Please check your HTML.");
            return;
        } else {
            console.log("Add Field button found");
        }

        $("#addFieldButton").on("click", function () {
            console.log("Add Field button clicked!");
            fieldIndex++;

            let newFieldBlock = `
                <div class="query-block">
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="field${fieldIndex}">Field ${fieldIndex}:</label>
                            <select name="field[]" id="field${fieldIndex}" class="form-control" required>
                                <option value="all">All Fields</option>
                                <option value="NVIC_ID">NVIC ID</option>
                                <option value="Inhibitor_name">Inhibitor</option>
                                <option value="Target">Target</option>
                                <option value="Assay_type">Assay Type</option>
                                <option value="IC50_nM">IC50 (nM)</option>
                                <option value="EC50_nM">EC50 (nM)</option>
                                <option value="Outcome">Outcome</option>
                                <option value="Pubmed_id">PubMed ID</option>
                                <option value="MW">Molecular Weight</option>
                                <option value="HBA">HBA</option>
                                <option value="HBD">HBD</option>
                                <option value="RB">RB</option>
                                <option value="LogP">LogP</option>
                                <option value="TPSA">TPSA</option>
                                <option value="Pubmed_id">PubMed ID</option>
                                <!-- Add more options here -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="field_op${fieldIndex}">Operator:</label>
                            <select name="field_op[]" id="field_op${fieldIndex}" class="form-control" required>
                                <option value="like">LIKE</option>
                                <option value="not like">NOT LIKE</option>
                                <option value="equal">EQUAL</option>
                                <option value="not_equal">NOT EQUAL</option>
                                <option value="<">&lt;</option>
                                <option value=">">&gt;</option>
                                <option value="<=">&lt;=</option>
                                <option value=">=">&gt;=</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="keyword${fieldIndex}">Keyword:</label>
                            <input type="text" name="keyword[]" id="keyword${fieldIndex}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-3">
                            <label for="logic${fieldIndex}">Logical Operator:</label>
                            <select name="logic_op[]" id="logic${fieldIndex}" class="form-control">
                                <option value="AND">AND</option>
                                <option value="OR">OR</option>
                            </select>
                        </div>
                    </div>
                </div>
            `;

            $("#queryContainer").append(newFieldBlock);
            console.log("New field block added. Total fields: " + fieldIndex);
        });

        console.log("Script loaded and ready. Waiting for Add Field button clicks.");
    });
})();
