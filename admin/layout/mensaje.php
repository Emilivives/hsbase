<?php
if ((isset($_SESSION['mensaje'])) && (isset($_SESSION['icono']))) {
    $respuesta = $_SESSION['mensaje'];
    $icono = $_SESSION['icono']; ?>
    <script>
        Swal.fire({
			position: "top-end",
            //icon: '<?php echo $icono; ?>',
            text: '<?php echo $respuesta; ?>',
	
			 showConfirmButton: false,
           // imageUrl: '../../public/img/LOGO 2.jpg',
            //imageWidth: 235,
            //imageHeight: 100,
            //imageAlt: 'Custom image',
        })
    </script>
<?php
    unset($_SESSION['mensaje']);
}
?>