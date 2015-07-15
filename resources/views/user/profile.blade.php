<div class="" style="border:none">
    <div class="tab-pane active">
        <div class="space-12"></div>

        <!-- #section:pages/profile.info -->
        <div class="ui segment profile-user-info profile-user-info-striped">
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

        <div class="widget no-padding bordered-top bordered-darkpink">
            <div class="widget-header">
                <i class="widget-icon alternate list icon"></i>
                <span class="widget-caption">Recent activity</span>
                <div class="widget-buttons">
                    <a href="#" class="ui tiny basic icon button" data-toggle="refresh">
                        <i class="icon refresh"></i>
                    </a>
                </div><!--Widget Buttons-->
            </div>

            <div class="widget-body uk-padding-remove">
                <div class="">
                    <div class="ui relaxed list profile-feed">
                        <div class="item profile-activity">
                            <i class="circular large icon check no-hover"></i>
                            <div class="content" style="width: 100%;">
                                <span class="time uk-text-muted uk-float-right">
                                    <i class="icon clock"></i>an hour ago
                                </span>
                                <a class="user header">Rachel</a>
                                <div class="description">
                                    Last seen watching <a><b>Arrested Development</b></a>
                                </div>
                            </div>
                        </div>
                        <div class="item profile-activity">
                            <i class="circular large icon check no-hover"></i>
                            <div class="content" style="width: 100%;">
                                <span class="time uk-text-muted uk-float-right">
                                    <i class="icon clock"></i>10 hours ago
                                </span>
                                <a class="user header">Lindsay</a>
                                <div class="description">Last seen watching <a><b>Bob's Burgers</b></a></div>
                            </div>
                        </div>
                        <div class="item profile-activity">
                            <i class="circular large icon check no-hover"></i>
                            <div class="content" style="width: 100%;">
                                <span class="time uk-text-muted uk-float-right">
                                    <i class="icon clock"></i>10 hours ago
                                </span>
                                <a class="user header">Lindsay</a>
                                <div class="description">Last seen watching <a><b>Bob's Burgers</b></a></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="space-6"></div>

            <div class="center aligned ui basic segment">
                <button type="button" class="ui white icon labeled button">
                    <i class="left rss icon"></i>
                    <span>View more activities</span>
                    <i class="right icon arrow right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

