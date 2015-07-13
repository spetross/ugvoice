<div class="ui segment uk-padding-remove" style="border:none">
    <div class="tab-pane active">
        <div class="space-12"></div>

        <!-- #section:pages/profile.info -->
        <div class="profile-user-info profile-user-info-striped">
            <div class="profile-info-row">
                <div class="profile-info-name"> Username</div>
                <div class="profile-info-value">
                            <span class="editable editable-click" id="username">
                            {{ $user->username }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name">Email</div>

                <div class="profile-info-value">
                    <span class="" id="email">{{ $user->email }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Name</div>

                <div class="profile-info-value">
                    <i class="fa fa-user light-orange bigger-110"></i>
                    <span>{{ $user->name }}</span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> Age</div>

                <div class="profile-info-value">
                    <span class="" id="age"></span>
                </div>
            </div>

            <div class="profile-info-row">
                <div class="profile-info-name"> About Me</div>

                <div class="profile-info-value">
                    {{ str_limit(strip_tags($user->bio), 150) }}
                </div>
            </div>
        </div>

        <!-- /section:pages/profile.info -->
        <div class="space-20"></div>

        <div class="ui segment widget-box transparent">
            <div class="widget-header widget-header-small">
                <h4 class="widget-title blue smaller">
                    <i class="ace-icon fa fa-rss orange"></i>
                    Recent Activities
                </h4>

                <div class="widget-toolbar action-buttons">
                    <a href="#" data-action="reload">
                        <i class="ace-icon fa fa-refresh blue"></i>
                    </a>
                    &nbsp;
                    <a href="#" class="pink">
                        <i class="ace-icon fa fa-trash-o"></i>
                    </a>
                </div>
            </div>

            <div class="widget-body">
                <div class="widget-main padding-8">
                    <!-- #section:pages/profile.feed -->
                    <div id="profile-feed-1" class="profile-feed ace-scroll" style="position: relative;">
                        <div class="profile-activity clearfix">
                            <div>
                                <img class="pull-left" alt="Alex Doe's avatar" src="/img/avatar/d/100.png">
                                <a class="user" href="#"> Alex Doe </a>
                                changed his profile photo.
                                <a href="#">Take a look</a>

                                <div class="time">
                                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                    an hour ago
                                </div>
                            </div>

                            <div class="tools action-buttons">
                                <a href="#" class="blue">
                                    <i class="ace-icon fa fa-pencil bigger-125"></i>
                                </a>

                                <a href="#" class="red">
                                    <i class="ace-icon fa fa-times bigger-125"></i>
                                </a>
                            </div>
                        </div>

                        <div class="profile-activity clearfix">
                            <div>
                                <i class="pull-left thumbicon fa fa-check btn-success no-hover"></i>
                                <a class="user" href="#"> Alex Doe </a>
                                joined
                                <a href="#">Country Music</a>

                                group.
                                <div class="time">
                                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                    5 hours ago
                                </div>
                            </div>

                            <div class="tools action-buttons">
                                <a href="#" class="blue">
                                    <i class="ace-icon fa fa-pencil bigger-125"></i>
                                </a>

                                <a href="#" class="red">
                                    <i class="ace-icon fa fa-times bigger-125"></i>
                                </a>
                            </div>
                        </div>

                        <div class="profile-activity clearfix">
                            <div>
                                <i class="pull-left thumbicon fa fa-picture-o btn-info no-hover"></i>
                                <a class="user" href="#"> Alex Doe </a>
                                uploaded a new photo.
                                <a href="#">Take a look</a>

                                <div class="time">
                                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                    5 hours ago
                                </div>
                            </div>

                            <div class="tools action-buttons">
                                <a href="#" class="blue">
                                    <i class="ace-icon fa fa-pencil bigger-125"></i>
                                </a>

                                <a href="#" class="red">
                                    <i class="ace-icon fa fa-times bigger-125"></i>
                                </a>
                            </div>
                        </div>


                        <div class="profile-activity clearfix">
                            <div>
                                <i class="pull-left thumbicon fa fa-pencil-square-o btn-pink no-hover"></i>
                                <a class="user" href="#"> Alex Doe </a>
                                published a new blog post.
                                <a href="#">Read now</a>

                                <div class="time">
                                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                    11 hours ago
                                </div>
                            </div>

                            <div class="tools action-buttons">
                                <a href="#" class="blue">
                                    <i class="ace-icon fa fa-pencil bigger-125"></i>
                                </a>

                                <a href="#" class="red">
                                    <i class="ace-icon fa fa-times bigger-125"></i>
                                </a>
                            </div>
                        </div>

                        <div class="profile-activity clearfix">
                            <div>
                                <i class="pull-left thumbicon fa fa-power-off btn-inverse no-hover"></i>
                                <a class="user" href="#"> Alex Doe </a>

                                logged out.
                                <div class="time">
                                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                    16 hours ago
                                </div>
                            </div>

                            <div class="tools action-buttons">
                                <a href="#" class="blue">
                                    <i class="ace-icon fa fa-pencil bigger-125"></i>
                                </a>

                                <a href="#" class="red">
                                    <i class="ace-icon fa fa-times bigger-125"></i>
                                </a>
                            </div>
                        </div>

                        <!-- /section:pages/profile.feed -->
                    </div>
                </div>
            </div>

            <div class="hr hr2 hr-double"></div>

            <div class="space-6"></div>

            <div class="center">
                <button type="button" class="btn btn-sm btn-primary btn-white btn-round">
                    <i class="ace-icon fa fa-rss bigger-150 middle orange2"></i>
                    <span class="bigger-110">View more activities</span>
                    <i class="icon-on-right ace-icon fa fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

