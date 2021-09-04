const { default: Swal } = require("sweetalert2")

const deleteAlert = (form) =>{
    Swal.fire({
        icon: 'warning',
        title: 'Are you sure?',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        confirmButtonColor: '#3085d6'
    }).then((result) => {
        if(result.isConfirmed) {
            // The user pressed yes. Submit the delete form.
            form.submit();
        }
    })
}

document.addEventListener('DOMContentLoaded', ()=>{
    if(document.querySelector(".btn-danger") !== null){
        document.querySelector(".btn-danger")
            .addEventListener("click", function(){
                let form = this.closest('form')
                deleteAlert(form)
            })
    }
    
})