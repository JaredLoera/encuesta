const passcompany = document.getElementById('passcompany');
const forms = document.querySelectorAll('.needs-validation');
Array.from(forms).forEach(form =>{
    form.addEventListener('submit', function(event){
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        if (passcompany.value.length < 8) {
           passcompany.classList.remove('is-valid');
           event.preventDefault();
           event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
})
passcompany.addEventListener('keyup', function() {
   
});

