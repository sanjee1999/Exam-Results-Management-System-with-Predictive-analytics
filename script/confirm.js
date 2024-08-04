// function confirmDelete(event) {
//   event.preventDefault(); // Prevent the form from submitting

//   if (confirm("Are you sure you want to delete this record?")) {
//       // If confirmed, submit the form
//       document.getElementById('action').value = 'delete';
//       document.getElementById('myForm').submit();
//       console.log('delete');
//   }
// }

// function updateRecord() {
//   document.getElementById('action').value = 'update';
//   document.getElementById('myForm').submit();
//   console.log('update');
// }


    function confirmDelete(event, formId) {
        event.preventDefault(); // Prevent the form from submitting

        if (confirm("Are you sure you want to delete this record?")) {
            // If confirmed, set the action and submit the form
            document.getElementById('action_' + formId).value = 'delete';
            document.getElementById(formId).submit();
        }
    }

    function updateRecord(formId) {
        document.getElementById('action_' + formId).value = 'update';
        document.getElementById(formId).submit();
    }
   

