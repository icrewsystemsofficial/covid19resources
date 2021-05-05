<footer class="footer bg-black-gradient text-white" id="footer">
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
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#shareModal">
                        Share
                    </a>
                </li>

                <style>
                                    .resp-sharing-button__link,
                .resp-sharing-button__icon {
                display: inline-block
                }

                .resp-sharing-button__link {
                text-decoration: none;
                color: #fff;
                margin: 0.5em
                }

                .resp-sharing-button {
                border-radius: 5px;
                transition: 25ms ease-out;
                padding: 0.5em 0.75em;
                font-family: Helvetica Neue,Helvetica,Arial,sans-serif
                }

                .resp-sharing-button__icon svg {
                width: 1em;
                height: 1em;
                margin-right: 0.4em;
                vertical-align: top
                }

                .resp-sharing-button--small svg {
                margin: 0;
                vertical-align: middle
                }

               

                /* Solid icons get a fill */
                .resp-sharing-button__icon--solid,
                .resp-sharing-button__icon--solidcircle {
                fill: #fff;
                stroke: none
                }

                .resp-sharing-button--twitter {
                background-color: #55acee
                }

                .resp-sharing-button--twitter:hover {
                background-color: #2795e9
                }

              

             
                .resp-sharing-button--facebook {
                background-color: #3b5998
                }

                .resp-sharing-button--facebook:hover {
                background-color: #2d4373
                }

                .resp-sharing-button--linkedin {
                background-color: #0077b5
                }

                .resp-sharing-button--linkedin:hover {
                background-color: #046293
                }


                .resp-sharing-button--whatsapp {
                background-color: #25D366
                }

                .resp-sharing-button--whatsapp:hover {
                background-color: #1da851
                }


                .resp-sharing-button--facebook {
                background-color: #3b5998;
                border-color: #3b5998;
                }

                .resp-sharing-button--facebook:hover,
                .resp-sharing-button--facebook:active {
                background-color: #2d4373;
                border-color: #2d4373;
                }

                .resp-sharing-button--twitter {
                background-color: #55acee;
                border-color: #55acee;
                }

                .resp-sharing-button--twitter:hover,
                .resp-sharing-button--twitter:active {
                background-color: #2795e9;
                border-color: #2795e9;
                }

                .resp-sharing-button--linkedin {
                background-color: #0077b5;
                border-color: #0077b5;
                }

                .resp-sharing-button--linkedin:hover,
                .resp-sharing-button--linkedin:active {
                background-color: #046293;
                border-color: #046293;
                }

                .resp-sharing-button--whatsapp {
                background-color: #25D366;
                border-color: #25D366;
                }

                .resp-sharing-button--whatsapp:hover,
                .resp-sharing-button--whatsapp:active {
                background-color: #1DA851;
                border-color: #1DA851;
                }


                </style>

                <!-- Modal -->
                <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="shareModalLabel">Modal title</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <!-- Sharingbutton Facebook -->
                            <a class="resp-sharing-button__link text-white" style="text-decoration:none " href="https://facebook.com/sharer/sharer.php?u=http%3A%2F%2Fsharingbuttons.io" target="_blank" rel="noopener" aria-label="Share on Facebook">
                                <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--large"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18.77 7.46H14.5v-1.9c0-.9.6-1.1 1-1.1h3V.5h-4.33C10.24.5 9.5 3.44 9.5 5.32v2.15h-3v4h3v12h5v-12h3.85l.42-4z"/></svg>
                                  </div>Share on Facebook</div>
                              </a>

                              <!-- Sharingbutton Twitter -->
                              <a class="resp-sharing-button__link text-white" style="text-decoration:none" href="https://twitter.com/intent/tweet/?text=Super%20fast%20and%20easy%20Social%20Media%20Sharing%20Buttons.%20No%20JavaScript.%20No%20tracking.&amp;url=http%3A%2F%2Fsharingbuttons.io" target="_blank" rel="noopener" aria-label="Share on Twitter">
                                <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--large"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M23.44 4.83c-.8.37-1.5.38-2.22.02.93-.56.98-.96 1.32-2.02-.88.52-1.86.9-2.9 1.1-.82-.88-2-1.43-3.3-1.43-2.5 0-4.55 2.04-4.55 4.54 0 .36.03.7.1 1.04-3.77-.2-7.12-2-9.36-4.75-.4.67-.6 1.45-.6 2.3 0 1.56.8 2.95 2 3.77-.74-.03-1.44-.23-2.05-.57v.06c0 2.2 1.56 4.03 3.64 4.44-.67.2-1.37.2-2.06.08.58 1.8 2.26 3.12 4.25 3.16C5.78 18.1 3.37 18.74 1 18.46c2 1.3 4.4 2.04 6.97 2.04 8.35 0 12.92-6.92 12.92-12.93 0-.2 0-.4-.02-.6.9-.63 1.96-1.22 2.56-2.14z"/></svg>
                                  </div>Share on Twitter</div>
                              </a>

                              <!-- Sharingbutton LinkedIn -->
                              <a class="resp-sharing-button__link text-white" style="text-decoration:none" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=http%3A%2F%2Fsharingbuttons.io&amp;title=Super%20fast%20and%20easy%20Social%20Media%20Sharing%20Buttons.%20No%20JavaScript.%20No%20tracking.&amp;summary=Super%20fast%20and%20easy%20Social%20Media%20Sharing%20Buttons.%20No%20JavaScript.%20No%20tracking.&amp;source=http%3A%2F%2Fsharingbuttons.io" target="_blank" rel="noopener" aria-label="Share on LinkedIn">
                                <div class="resp-sharing-button resp-sharing-button--linkedin resp-sharing-button--large"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.5 21.5h-5v-13h5v13zM4 6.5C2.5 6.5 1.5 5.3 1.5 4s1-2.4 2.5-2.4c1.6 0 2.5 1 2.6 2.5 0 1.4-1 2.5-2.6 2.5zm11.5 6c-1 0-2 1-2 2v7h-5v-13h5V10s1.6-1.5 4-1.5c3 0 5 2.2 5 6.3v6.7h-5v-7c0-1-1-2-2-2z"/></svg>
                                  </div>Share on LinkedIn</div>
                              </a>

                              <!-- Sharingbutton WhatsApp -->
                              <a class="resp-sharing-button__link text-white" style="text-decoration:none" href="whatsapp://send?text=Super%20fast%20and%20easy%20Social%20Media%20Sharing%20Buttons.%20No%20JavaScript.%20No%20tracking.%20http%3A%2F%2Fsharingbuttons.io" target="_blank" rel="noopener" aria-label="Share on WhatsApp">
                                <div class="resp-sharing-button resp-sharing-button--whatsapp resp-sharing-button--large"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                                  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.1 3.9C17.9 1.7 15 .5 12 .5 5.8.5.7 5.6.7 11.9c0 2 .5 3.9 1.5 5.6L.6 23.4l6-1.6c1.6.9 3.5 1.3 5.4 1.3 6.3 0 11.4-5.1 11.4-11.4-.1-2.8-1.2-5.7-3.3-7.8zM12 21.4c-1.7 0-3.3-.5-4.8-1.3l-.4-.2-3.5 1 1-3.4L4 17c-1-1.5-1.4-3.2-1.4-5.1 0-5.2 4.2-9.4 9.4-9.4 2.5 0 4.9 1 6.7 2.8 1.8 1.8 2.8 4.2 2.8 6.7-.1 5.2-4.3 9.4-9.5 9.4zm5.1-7.1c-.3-.1-1.7-.9-1.9-1-.3-.1-.5-.1-.7.1-.2.3-.8 1-.9 1.1-.2.2-.3.2-.6.1s-1.2-.5-2.3-1.4c-.9-.8-1.4-1.7-1.6-2-.2-.3 0-.5.1-.6s.3-.3.4-.5c.2-.1.3-.3.4-.5.1-.2 0-.4 0-.5C10 9 9.3 7.6 9 7c-.1-.4-.4-.3-.5-.3h-.6s-.4.1-.7.3c-.3.3-1 1-1 2.4s1 2.8 1.1 3c.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.6-.1 1.7-.7 1.9-1.3.2-.7.2-1.2.2-1.3-.1-.3-.3-.4-.6-.5z"/></svg>
                                  </div>Share on WhatsApp</div>
                              </a>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>


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
