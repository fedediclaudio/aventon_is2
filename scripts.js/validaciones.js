function validarMail()
  {
    console.log(document.getElementById('mailInput').value);
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById('mailInput').value))
    {
      document.getElementById('formularioViaje').setAttribute('action',"../crearUsuario.php")
      return (true)
    }
      alert("Se ha ingresado un mail erroneo")
      return (false)
  }
