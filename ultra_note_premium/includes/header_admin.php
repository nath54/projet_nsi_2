
<div class="header">
    <div class="header_left">
        <a href="#" onclick="change_page('accueil_admin');" class="hel ha">Ultranote</a>
        <a href="includes/disconnect.php" class="hel bt_sortie"></a>
        <?php include "header_compte.php"; ?>
    </div>

    <div id="header_right" class="header_right">
        <button onclick="change_page('comptes_admin','bth_comptes');"  id="bth_comptes" class="bt_header">Gestion Comptes</button>
        <button onclick="change_page('emplois_temps_admin','bth_emploi');"  id="bth_emploi" class="bt_header">Gestion Emplois du Temps</button>
        <button onclick="change_page('etablissement_admin','bth_etablissement');"  id="bth_etablissement" class="bt_header">Gestion Etablissement</button>
        <button onclick="change_page('messagerie','bth_messagerie');"  id="bth_messagerie" class="bt_header">Messagerie</button>
    </div>
</div>


