<div class="ui grid">
    <div class="four wide computer five wide tablet ony center aligned column">
        <a href="" class="ui fluid button"><i class="write icon"></i> Post</a>

        <div class="ui vertical fluid menu">
            <div class="item">
                <div class="ui transparent icon input">
                    <input placeholder="Search..." type="text">
                    <i class="search link icon"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="twelve wide computer eleven wide tablet sixteen wide mobile column">
        <ul class="posts timeline">
            <li class="post form">
                <div class="timeline-badge blue color">
                    <i class="write icon"></i>
                </div>
                <div class="timeline-panel">
                    <div class="timeline-body">
                        <?php
                        $uploadConfig = [
                                'displayMode' => 'image-multi',
                                'imageHeight' => 100,
                                'imageWidth' => 100,
                                'fileList' => json_encode([]),
                                'acceptedFileTypes' => '.jpg,.jpeg,.bmp,.png,.gif,.svg',
                                'uniqueId' => 'Post-Images'
                        ];
                        ?>
                        <form class="ui post tabbed form" data-client="{{$client->slug}}" method="post">
                            <div class="ui top attached tabular menu">
                                <a href="#" class="active item" data-tab="post-compose"><i
                                            class="pencil square icon"></i> Post</a>
                                <a href="#" class="item" data-tab="post-media"><i class="image icon"></i> Add Photo</a>
                                <a href="#" class="item" data-tab="post-link"><i class="linkify icon"></i> Add Link</a>
                            </div>
                            <div class="ui bottom attached attached active tab segment padding-5"
                                 data-tab="post-compose">
                                <textarea rows="2" name="Post[content]" class="auto text status"
                                          placeholder="Have something to share"></textarea>

                                <div class="field form-actions padding-5 hidden">
                                    <div class="ui checkbox margin-top-10 margin-left-10">
                                        <input type="checkbox" id="private_post" name="post_private" tabindex="0">
                                        <label for="private_post">Hide identity</label>
                                    </div>
                                    <button type="submit" class="ui small right floated submit primary icon button">Post
                                        <i class="check icon"></i></button>
                                    <button type="reset" class="ui small right floated reset button">Cancel <i
                                                class=""></i></button>
                                </div>
                            </div>
                            <div class="ui bottom attached tab segment padding-5" data-tab="post-media">
                                @include('partials.fileupload.image_multi', $uploadConfig)
                            </div>
                            <div class="ui bottom attached tab segment padding-5" data-tab="post-link">
                                <textarea rows="1" class="text link" name="Post[link]"
                                          placeholder="Share a link ..."></textarea>

                                <div class="field form-actions padding-5">
                                    <button type="submit" class="ui small icon primary button">Share <i
                                                class="arrow right icon"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
            @forelse($posts as $post)
                @include('client.posts.post', compact('post'))
            @empty

            @endforelse
            @if($posts->hasMorePages())
                <li class="timeline-node">
                    <a class="ui basic yellow button">LOAD MORE</a>
                </li>
            @endif
        </ul>
    </div>
</div>