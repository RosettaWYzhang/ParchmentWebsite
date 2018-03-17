function startService(){
    //check which checkboxes for dataset are ticked
    //difference checkboxes for pipeline can be ignored since we are only using bundler

    //get number of datasets
    var datasetNum = document.getElementsByName("dataset-check").length;
    var id = 0;
    for (id = 1; id <= datasetNum; id++) {
        if(document.getElementById(id).checked){
            break;
        }
    }
    //after exiting this loop, we know which dataset the user has selected

$.ajax({
    data: 'id=' + id,
    url: 'callBundlerWithDataset.php',
    method: 'POST', // or GET
    success: function(msg) {
        alert(msg);
    }
});



}

}
