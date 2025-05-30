
<?php 

?>

<div class="loading-overlay">
  <div class="spinner-border text-primary" style="width: 15rem; height: 15rem;" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>

<style>
  .loading-overlay {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    background: rgba(255, 255, 255, 0.9) !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    z-index: 999999999 !important;
    pointer-events: none !important;
    overflow: hidden !important;
  }



</style>
