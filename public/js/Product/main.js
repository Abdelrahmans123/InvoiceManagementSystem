//edit Modal
function showeditModal() {
    $('#exampleModal2').modal('show')
}
function loadEditModal() {
    let button = document.getElementById('editbtn');
    let id = button.getAttribute ('data-productid')
    let departmentName = button.getAttribute ('data-department_name')
    let productName = button.getAttribute ('data-product_name')
    let description = button.getAttribute ('data-description')
    let idValue=document.querySelector('.modal-body #id');
    let productNameValue=document.querySelector('.modal-body #productname');
    let departmentNameValue=document.querySelector('.modal-body #departmentname');
    let descriptionValue=document.querySelector('.modal-body #productdescription');
    idValue.value=id;
    productNameValue.value=productName;
    departmentNameValue.value=departmentName;
    descriptionValue.value=description;
    showeditModal();
}
//delete Modal
function showdeleteModal(){
    $('#modaldemo9').modal('show')
}
function loadDeleteModal(){
    let button = document.getElementById('deletebtn');
    let id = button.getAttribute ('data-id');
    let productName = button.getAttribute ('data-productName');
    let idValue=document.querySelector('.modal-body #productid');
    let productNameValue=document.querySelector('.modal-body #product');
    console.log(productNameValue);
    idValue.value=id;
    productNameValue.value=productName;
    showdeleteModal();
}
