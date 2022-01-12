  function check_all(){
    var checkBoxes=document.getElementsByName('deleteboxes[]');
    var deleteall= document.getElementById('deleteAllBox');
    for (var i=0; i<checkBoxes.length ; i++){
        if (deleteall.checked==true){
        checkBoxes[i].checked=true;
            
        }
        else {
            checkBoxes[i].checked=false;
        }
    }
  }
  function check_all2(){
    var checkBoxes=document.getElementsByName('approvedAdmins[]');
    var deleteall= document.getElementById('deleteAllBox');
    for (var i=0; i<checkBoxes.length ; i++){
        if (deleteall.checked==true){
        checkBoxes[i].checked=true;
            
        }
        else {
            checkBoxes[i].checked=false;
        }
    }
  }
function checkCity(x){
    var city=document.getElementById("city");
    city.value=x;
  }
function checkNature(x){
    var nature=document.getElementById("nature");
    nature.value=x;
  }
  function checkSeason(x){
    var season=document.getElementById("season");
    season.value=x;
  }