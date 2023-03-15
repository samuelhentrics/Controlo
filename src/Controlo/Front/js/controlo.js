document.addEventListener('keydown', function(event) {
    if (event.ctrlKey && event.keyCode === 79) {
        event.preventDefault();
        // ajouter ici le code que vous souhaitez exécuter à la place de l'action par défaut
        play()
        
      }
  })
  function play() {
    var audio = new Audio('Controlo/Front/videos/Controlooo.mp4');
    audio.play();
  }