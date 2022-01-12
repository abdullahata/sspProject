    function viewDetails(id){
      var form = document.createElement("form");
      form.setAttribute("method", "post");
      form.setAttribute("action", "details.php");
      form.setAttribute("id", "myForm");
      // Create an input element for  place ID
      var ID = document.createElement("input");
      ID.setAttribute("type", "number");
      ID.setAttribute("name", "ID");
      ID.setAttribute("value", id);
      
      var s = document.createElement("input");
                s.setAttribute("type", "submit");
                s.setAttribute("value", "Submit");
  
                form.append(ID); 
                form.append(s); 
                document.getElementsByTagName("body")[0]
               .appendChild(form);
      form=document.getElementById('myForm');
      form.submit();
    }
