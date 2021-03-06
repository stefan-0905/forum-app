
<div class="modal" id="boardSettingsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title">Board Settings</h5>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-4">
                    <h5>Board</h5>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <?php 
                    $board_list = BoardList::find_all();
                    $bulletin_num = 1;
                    foreach($board_list as $board_item) {
                        $board_item_title = strtolower($board_item->title);
                        $board_item_title = str_replace(" ", "-", $board_item_title);
                    ?>
                    <a class="<?php echo "tab-bulletin".$bulletin_num++; ?> nav-link" id="v-pills-<?php echo $board_item_title; ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $board_item_title; ?>" role="tab" aria-controls="v-pills-<?php echo $board_item_title; ?>" aria-selected="false"><?php echo $board_item->title; ?></a>
                    
                    <?php } ?>
                    </div>
                </div>
                <div class="col-8">
                    <h5>Topics:</h5>
                    <div class="tab-content" id="v-pills-tabContent">
                    <?php
                    $bulletin_num = 1;
                    foreach($board_list as $board_item) {
                        $board_item_title = strtolower($board_item->title);
                        $board_item_title = str_replace(" ", "-", $board_item_title);
                    ?>
                    <div class="<?php echo "pane-bulletin".$bulletin_num++; ?> tab-pane fade" 
                         id="v-pills-<?php echo $board_item_title; ?>" 
                         role="tabpanel" 
                         aria-labelledby="v-pills-<?php echo $board_item_title; ?>-tab">
                         <ul class="list-unstyled">
                         <?php 
                         if($selected_topics = Topic::getRelatedTopics($board_item->id))
                         foreach($selected_topics as $selected_topic) :
                         ?>
                         <li class="border-top pt-2">
                            <div class="row no-gutters">
                                <h5 class="mb-2 col-md-10" title="<?php echo $selected_topic->title; ?>">
                                <?php 
                                $title = $selected_topic->title; 
                                // If string has more then 50 characters 
                                if(strlen($title) > 50) {
                                    // Adding 3 dots in string
                                    $title = wordwrap($title, 50, '...');
                                    // Cutting string after 3 dots
                                    $title = substr($title, 0, strpos($title, '...')+3);
                                }
                                echo $title;
                                ?>
                                </h5>
                                <a class="delete-topic col-md-2 btn btn-sm btn-danger text-light mb-2 py-0" data-id="<?php echo $selected_topic->id; ?>" title="Delete Topic">Delete</i></a>
                            </div>
                        </li>
                         <?php endforeach; ?>
                         </ul>
                    </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>