<script>
    document.querySelector('#img').addEventListener('change', function(){
       let src =  URL.createObjectURL(this.files[0]);
       let preview = document.querySelector('#preview');
       preview.src = src;
       preview.style.display= 'block'

    })
</script>

<img src=''  id='preview' style='display: none;' width= '100' height= '100'  alt="Upload Image">