<?php

include_once "../init.php";
include_once "../bdd.php";

echo "<script>var id_groupe=".$_GET["gid"].";</script>"

?>
<form id="form_group" name="form_group" method="POST" action="modify_group2.php">
    <input id="eleves" name="eleves" style="display:none;" value=""/>
    <div id="eleves">

    </div>
    <a class="bt" href="#" onclick="">Ok</a>
</form>
<script>
</script>