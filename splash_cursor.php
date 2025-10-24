<!-- splash_cursor.php
<style>
  body {
    cursor: none;
  }
.splash {
      position: absolute;
      width: 10px;
      height: 15px;
      background: rgba(46, 44, 44, 0.8);
      border-radius: 50%;
      pointer-events: none;
      transform: translate(-50%, -50%);
      animation: splash 0.5s ease-out forwards;
    }

    @keyframes splash {
      0% { transform: translate(-50%, -50%) scale(1); opacity: 0; }
      100% { transform: translate(-50%, -50%) scale(6); opacity: 1; }
    }
  
</style>

<script>
 document.addEventListener('mousemove', e => {
    const splash = document.createElement('div');
    splash.classList.add('splash');
    splash.style.left = e.pageX + 'px';
    splash.style.top = e.pageY + 'px';
    document.body.appendChild(splash);

    // remove after animation
    setTimeout(() => splash.remove(), 100);
  });
</script> -->
