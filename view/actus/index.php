<?php
foreach($actus as $k => $v):
?>
<div class="page-header h2">
    <h2> <?php echo $v->name; ?> </h2>
</div>

<div class="container">
    <?php echo $v->content; ?>
</div>

<div class="bottom-left">
    
    <a href="<?php echo Router::url("actus/view/id:{$v->id}/slug:{$v->slug}"); ?>"> Voir les articles </a>
</div>

<?php endforeach;  ?>

<nav>
  <ul class="pagination">
      <?php for($i=1; $i <= $pages; $i++): ?>
    <li <?php if($i==$this->request->page) echo 'class="active"';?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?> <span class="sr-only">(current)</span></a></li>
    <?php endfor; ?>
  </ul>
</nav>