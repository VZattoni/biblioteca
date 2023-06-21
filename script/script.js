function openContainer(idOpen, idClose){
    let eOpen = document.getElementById(idOpen);
    let eClose = document.getElementById(idClose);

    eOpen.style.display = 'flex';
    eClose.style.display = 'none';

}


function mostrarOcultarSenhaLogin() {
    var senha  = document.getElementById("Senha");
  
    if (senha.type == "password"){
      senha.type  = "text";
    } else {
      senha.type  = "password";
    }
  }

  function mostrarOcultarSenhaCadastro() {
    var senha1 = document.getElementById("Senha1");
    var senha2 = document.getElementById("Senha2");
  
    if (senha1.type == "password"){
      senha1.type = "text";
      senha2.type = "text";
    } else {
      senha1.type = "password";
      senha2.type = "password";
    }
  }


  function mask(o, f) {
    setTimeout(function() {
      var v = mphone(o.value);
      if (v != o.value) {
        o.value = v;
      }
    }, 1);
  }
  
  
  function mphone(v) {
    var r = v.replace(/\D/g, "");
    r = r.replace(/^0/, "");
    if (r.length > 10) {
      r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1)$2-$3");
    } else if (r.length > 5) {
      r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1)$2-$3");
    } else if (r.length > 2) {
      r = r.replace(/^(\d\d)(\d{0,5})/, "($1)$2");
    } else {
      r = r.replace(/^(\d*)/, "($1");
    }
    return r;
  }
  
  function mensagem(m) {
    alert(m);
  }


  function sendUrl(id, e){
    if(e){
      window.location.href = "deleteLivro.php?id=" + id;
    }else{
      window.location.href = "updateLivro.php?id=" + id;

    }
  }