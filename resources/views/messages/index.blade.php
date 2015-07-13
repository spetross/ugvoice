<div class="">
    <div class="ui top attached segment padding-5">
        <h4 class="margin-top-10">
            <i class="icon fa fa-comment blue"></i>
            Conversation
        </h4>
    </div>
    <div class="ui bottom attached segment messages-container">
        <div class="no-padding">
            <!-- #section:pages/dashboard.conversations -->
            @if(!Request::has('user'))
                <div class="messages-list ace-scroll">
                    <ul class="list-group">
                        <li class="list-group-item active">
                            <a href="{{ route('messages', ['user' => 2]) }}">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="/img/avatar/m/50.png" width="50" alt="">
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Today</span>
                                        <span class="user">Mary D.</span>

                                        <div class="message">Are we ok to meet...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('messages', ['user' => 1]) }}">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="/img/avatar/m/50.png" height="50" alt="">
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>

                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('messages', ['user' => 1]) }}">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="/img/avatar/m/50.png" width="50" alt="">
                                    </div>
                                    <div class="media-body">
                                        <span class="date">5 days</span>
                                        <span class="user">Michelle A.</span>

                                        <div class="message">Nice design.</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('messages', ['user' => 1]) }}">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="/img/avatar/t/50.png" height="50" alt="">
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Sue T.</span>

                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('messages', ['user' => 2]) }}">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="/img/avatar/a/50.png" height="50" alt="">
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>

                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('messages', ['user' => 2]) }}">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="/img/avatar/m/50.png" height="50" alt="">
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>

                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('messages', ['user' => 2]) }}">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="/img/avatar/m/50.png" height="50" alt="">
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>

                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('messages', ['user' => 2]) }}">
                                <div class="media">
                                    <div class="media-object pull-left">
                                        <img src="/img/avatar/a/50.png" height="50" alt="">
                                    </div>
                                    <div class="media-body">
                                        <span class="date">Sat</span>
                                        <span class="user">Adrian T.</span>

                                        <div class="message">Looking forward to...</div>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                <div class="padding-20 ace-scroll" data-size="350">
                    <div class="chat-activity-list">

                        <div class="chat-element">
                            <a href="#" class="pull-left">
                                <img alt="image" class="img-circle" src="/img/avatar/a/100.png">
                            </a>

                            <div class="media-body ">
                                <small class="pull-right text-navy">
                                    <i class="ace-icon fa fa-clock-o"></i>
                                    <span class="blue">5m ago</span>
                                </small>
                                <strong>Mike Smith</strong>

                                <p class="m-b-xs">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been
                                </p>
                                <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                            </div>
                        </div>

                        <div class="chat-element right">
                            <a href="#" class="pull-right">
                                <img alt="image" class="img-circle" src="/img/avatar/b/100.png">
                            </a>

                            <div class="media-body text-right ">
                                <small class="pull-left">
                                    <i class="ace-icon fa fa-clock-o"></i>
                                    <span class="blue">5m ago</span>
                                </small>
                                <strong>John Smith</strong>

                                <p class="m-b-xs">
                                    Lorem Ipsum is simply dummy text of the printing.
                                </p>
                                <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                            </div>
                        </div>

                        <div class="chat-element ">
                            <a href="#" class="pull-left">
                                <img alt="image" class="img-circle" src="/img/avatar/a/100.png">
                            </a>

                            <div class="media-body ">
                                <small class="pull-right">
                                    <i class="ace-icon fa fa-clock-o"></i>
                                    <span class="blue">5m ago</span>
                                </small>
                                <strong>Mike Smith</strong>

                                <p class="m-b-xs">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                    Ipsum has been
                                </p>
                                <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="chat-form padding-5">
                    <form class="ui msg form " role="form">
                        <div class="form-group">
                            <textarea class="auto text" rows="2" placeholder="Message"></textarea>
                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-primary"><strong>Send message</strong></button>
                        </div>
                    </form>
                </div>
            @endif

        </div>
        <!-- /.widget-main -->
    </div>
    <!-- /.widget-body -->
</div>

