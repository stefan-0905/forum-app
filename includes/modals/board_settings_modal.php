
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
                    
                    <!-- <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a> -->
                    </div>
                </div>
                <div class="col-8">
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
                         $selected_topics = Topic::getRelatedTopics($board_item->id);
                         foreach($selected_topics as $selected_topic) :
                         ?>
                         <li class="border-top pt-2">
                            <div class="row">
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
                                <a class="delete-topic col-md-2 text-danger" data-id="<?php echo $selected_topic->id; ?>" title="Delete Topic"><i class="fa fa-times"></i></a>
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