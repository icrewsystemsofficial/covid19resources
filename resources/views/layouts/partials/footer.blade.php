<footer class="footer bg-black-gradient text-white">
    <div class="ml-4">
        <h2 class="h3">
            <strong>{{ config('app.name') }}</strong>
            <br>
                @php
                    $keywords = config('app.tweet_keywords');
                    $string = '';
                    $i = 0;
                    foreach($keywords as $keyword) {


                        if($i != 0) {
                            $string .= ' ';
                        }

                        $string .= $keyword;
                        $i++;
                    }
                @endphp
        </h2>
        <small><i class="fa fa-sync fa-spin text-succes"></i></small>    Currently monitoring all tweets for <strong>{{ $string }}</strong>
        <script type="text/javascript" src="//rf.revolvermaps.com/0/0/8.js?i=5tywu4nxx1u&amp;m=0c&amp;c=ff0000&amp;cr1=ffffff&amp;f=calibri&amp;l=49&amp;s=176&amp;bv=35&amp;z=17&amp;lx=860&amp;ly=460&amp;hi=20&amp;hc=0f92d9&amp;cw=ffffff&amp;cb=0f92d9" async="async"></script>
    </div>
    <div class="container-fluid">
        <nav class="pull-left">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="https://www.tidio.com/talk/cdcm4i8ho2rteyjfwrzqa19csu0eiwm7" target="_blank">
                        Talk to us
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="https://twitter.com/icrewsystems" target="_blank">
                        Tweet us
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#share" target="_blank">
                        Share
                    </a>
                </li>

                <li class="nav-item mr-2 ml-5">
                    <a href="https://instagram.com/covid19verifiedresources.in" class="nav-link" target="_blank">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                </li>


                <li class="nav-item ml-5">
                    <a href="https://github.com/icrewsystemsofficial" class="nav-link" target="_blank">
                        <i class="fab fa-github fa-lg"></i>
                    </a>    
                </li>
            </ul>
        </nav>

        <div class="copyright ml-auto">
       
            Developed & maintained with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.icrewsystems.com?ref={{ config('app.url') }}">icrewsystems</a>
        </div>
    </div>
</footer>
