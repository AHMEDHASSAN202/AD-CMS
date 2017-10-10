<!-- default Size -->
<div class="modal fade" id="modal-section" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel"><?php echo html_entity_decode($post->title); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo html_entity_decode($post->details); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>