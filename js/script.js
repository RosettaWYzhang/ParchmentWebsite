function startService(){
    //check which checkboxes for dataset are ticked
    //difference checkboxes for pipeline can be ignored since we are only using bundler at this stage

    //get number of datasets
    var datasetNum = document.getElementsByName("dataset-check").length;
    var id = 0;
    var isDataSelected = 0;
    for (id = 1; id <= datasetNum; id++) {
        if(document.getElementById(id).checked){
            isDataSelected = 1;
            console.log("dataset" + id + " selected");
            break;
        }
    }
    console.log(isDataSelected);
    if(isDataSelected==0){
        alert("You have not selected a dataset");
        return;
    }
    //after exiting this loop, we know which dataset the user has selected
    //create a popup window to remind user that the algorithms have started running
    alert("The algorithms have started. We will send you an email once the output is available.");

    $.ajax({
        data: 'id=' + id,
        url: 'callBundlerWithDataset.php',
        method: 'POST', // or GET
        success: function(msg) {
            alert(msg);
        }
    });



}

// functions to close the renaming window
function renameOnClick(index){
    var modal = document.getElementById('renameModal'+index);
    console.log("rename button is clicked");
    modal.style.display = "block";
}

function confirmOnClick(index){
    var modal = document.getElementById('renameModal'+index);
    modal.style.display = "none";
}
