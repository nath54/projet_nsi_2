<div class="header">
    <div class="header_left">
        <a href="#" onclick="change_page('accueil_eleve');" class="hel ha">Ultranote</a>
        <a href="includes/disconnect.php" class="hel bt_sortie"></a>
        <?php include "header_compte.php"; ?>
    </div>

    <div id="header_right" class="header_right">
        <button onclick="change_page('eleves_notes', 'bth_notes');" id="bth_notes" class="bt_header">Notes</button>
        <button onclick="change_page('eleves_devoirs', 'bth_devoirs');" id="bth_devoirs" class="bt_header">Devoirs</button>
        <button onclick="change_page('eleve_emplois_du_temps', 'bth_emploi');" id="bth_emploi" class="bt_header">Emplois du temps</button>
        <button onclick="change_page('messagerie', 'bth_messagerie');" id="bth_messagerie" class="bt_header">Messagerie</button>
    </div>
</div>