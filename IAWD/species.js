function filterSpecies() {
   
    var input = document.getElementById("search");
    var filter = input.value.toLowerCase();
    
    
    var table = document.getElementById("specialTable");
    var tr = table.getElementsByTagName("tr");
    
   
    for (var i = 1; i < tr.length; i++) {
        var td = tr[i].getElementsByTagName("td")[0];  
        if (td) {
            var txtValue = td.textContent || td.innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
