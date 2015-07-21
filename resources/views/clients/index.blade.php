
<div class="intro page uk-block">
      
    <!-- Container -->
    <div class="ui block container">
      <!-- Section Title -->
      <div class="section-title invert-colors uk-margin-bottom-remove">
        <h2 class="ui icon header">
            <i class="briefcase icon"></i>
            <div class="content">Organisations</div>
        </h2>
        <p></p>
      </div>
      <!-- /Section Title -->
    </div>
    <!-- /Container -->
  
</div>

<div class="main content uk-block bg-white">
    <div class="ui middle aligned center aligned grid">
        <div class="column" style="max-width: 450px;">
            <div class="innerTB">
                <form class="ui form" method="get" role="search">
                    <div class="ui fluid icon input">
                        <input type="text" placeholder="Search Organisations ...">
                        <i class="search icon"></i>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="ui block container">
        <div class="ui center cards">
            @include('clients.list')
        </div>
    </div>
</div>



