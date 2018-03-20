function startService(){
    //check which checkboxes for dataset are ticked
    //difference checkboxes for pipeline can be ignored since we are only using bundler

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

function renameOnClick(index){
    var modal = document.getElementById('renameModal'+index);
    console.log("rename button is clicked");
    modal.style.display = "block";
}

function confirmOnClick(index){
   //var confirm = document.getElementById('renameConfirmButton'+index);
   var modal = document.getElementById('renameModal'+index);
   modal.style.display = "none";
}

/*
// for renaming dataset
window.onload = function(){

// Get the modal
var modal = document.getElementById('renameModal');

// Get the button that opens the modal
var btn = document.getElementById("renameButton");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Get the confirm element that closes the modal
var confirm = document.getElementById("renameConfirmButton");

// When the user clicks on the button, open the modal
btn.onclick = function() {
    console.log("rename button is clicked");
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks on the confirm button, close the modal
confirm.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

};

*/
