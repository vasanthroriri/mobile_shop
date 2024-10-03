// edit function -------------------------
function editUiversity(editId) {
    alert("afa");

    $.ajax({
        url: 'action/actUniversity.php',
        method: 'POST',
        data: {
            editId: editId
        },
        //dataType: 'json', // Specify the expected data type as JSON
        success: function(response) {
            $('#editid').val(response.uni_id);
            $('#editUniversityName').val(response.uni_name);
            $('#editStudyCode').val(response.uni_study_code);
            
            // Handle arrays like uni_department and uni_contact
            if (Array.isArray(response.uni_department)) {
                // Assuming you want to display all departments in one input or textarea
                $('#editDepartments').val(response.uni_department.join(', '));
            } else {
                $('#editDepartments').val(response.uni_department);
            }
            
            if (Array.isArray(response.uni_contact)) {
                // Assuming you want to display all contacts in one input or textarea
                $('#editContacts').val(response.uni_contact.join(', '));
            } else {
                $('#editContacts').val(response.uni_contact);
            }
        },
        error: function(xhr, status, error) {
            // Handle errors here
            console.error('AJAX request failed:', status, error);
        }
    });
}
