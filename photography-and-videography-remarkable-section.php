    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }
		
		body{
			font-family: 'Barlow';
		}
		
		a{
			text-decoration: none;
			display: inline-block;
		}
		
		ul{
			padding: 0;
			margin: 0;
		}

        .remarkable-results-section {
            position: relative;
            background-color: #45D7D5;
            padding: 60px 0 0 0;
            margin: 0;
        }

        .remarkable-results-section .camera {
            position: absolute;
            right: 0;
            bottom: -58px;
            z-index: 1;
			max-width: 400px;
        }

        .remarkable-results-section .left-block {
            padding: 0;
            margin: 0;
        }

        .remarkable-results-section .left-block h3 {
            font-family: 'Beautique Display';
            font-size: clamp(1.625rem, 1.3472rem + 1.4815vw, 3.125rem);
            color: #0f0f0f;
            line-height: 1.1;
            font-weight: 400;
            text-transform: capitalize;
            padding: 0;
            margin: 30px 0;
        }

        .remarkable-results-section .left-block h3>span {
            display: block;
            color: rgb(255, 255, 255);
        }

        .remarkable-results-section .left-block .btn {
            font-family: 'Barlow';
            font-size: 16px;
            color: #fff;
            line-height: 1.3;
            font-weight: 400;
            background-color: #000;
            border-radius: 6px;
            padding: 10px 15px;
            margin: 0 0 30px 0;
        }

        .feats .block svg {
            width: 20px;
        }

        .feats .block p {
            width: calc(100% - 30px);
			font-family: inherit;
			font-size: 13px;
			margin: 0;
        }

        .imgs-block .block {
            width: 100%;
        }

        .imgs-block .block .img-holder {
            position: relative;
            /* clip-path: polygon(4% 0, 100% 0, 96% 100%, 0% 100%); */
        }

        .imgs-block .block .img-holder>img {
            clip-path: polygon(4% 0, 100% 0, 96% 100%, 0% 100%);
        }

        .imgs-block .block .img-holder figcaption {
            position: absolute;
            left: 0;
            right: 0;
            width: 90%;
            bottom: -10px;
            background-color: #000;
            text-transform: capitalize;
            color: #fff;
            text-align: left;
            font-size: 13px;
            border-radius: 6px;
            margin: auto;
            padding: 4px 10px;
            z-index: 999;
			display: flex;
			justify-content: center;
			align-items: center;
			gap: 6px;
        }

        .imgs-block .block .text-block {
            padding: 30px 0 0 0;
        }

        .imgs-block .block .text-block h4 {
            font-family: 'Beautique Display';
            font-size: 20px;
            color: #0f0f0f;
            line-height: 1.1;
            font-weight: 400;
            text-transform: capitalize;
            padding: 10px 0;
        }

        .imgs-block .block .text-block p {
            font-family: 'Barlow';
            font-size: 14px;
            color: #0f0f0f;
            line-height: 1.3;
            font-weight: 400;
            text-transform: capitalize;
        }

        .gallery-block {
			padding: 60px 0 0 0;
            margin: 0 0 20px 0;
        }
		
		.gallery-block .img-block {
    		width: calc(calc(100% - 40px) / 6);
		}
		
		.gallery-block .img-block > img{
			clip-path: polygon(4% 0, 100% 0, 96% 100%, 0% 100%);
		}

        .section-footer {
            background-color: #000;
            padding: 30px 0;
            color: #fff;
            text-transform: uppercase;
        }

        .section-footer .footer-item {
            font-family: 'barlow';
            width: max-content;
        }

         .section-footer .footer-item svg{
            width: 24px;
            height: 24px;
            fill: #fff;
         }
		
		.section-footer .footer-item p{
			margin: 0;
		}
		
		@media only screen and (max-width: 1090px){
			.remarkable-results-section .camera {
				max-width: 250px;
			}
		}
		
		@media only screen and (max-width: 767px){
			.remarkable-results-section .left-block {
				margin: 0 0 60px 0;
			}
			
			.feats .d-flex {
				flex-wrap: wrap;
			}
			.gallery-block .img-block {
    			width: calc(calc(100% - 40px) / 4);
			}
			.section-footer {
				padding: 30px 0 100px 0;
			}
		}
		
		@media only screen and (max-width: 700px){
			.section-footer {
				padding: 30px 0;
			}
			
			.section-footer .d-flex .footer-item {
				width: calc(50% - 2rem);
			}
			
			.remarkable-results-section .camera {
				max-width: 160px;
				bottom: 0;
			}

		}
		
		
		@media only screen and (max-width: 575px){
			.remarkable-results-section .camera {
				display: none;
			}
			.imgs-block .d-flex{
				flex-wrap: wrap;
				justify-content: center;
			}
			.imgs-block .d-flex .block{
				width: calc(50% - 8px);
				margin-bottom: 30px;
			}
			.imgs-block .d-flex .block:last-child{
				margin: 0;
			}
			
			.remarkable-results-section .camera {
				max-width: 170px;
			}
			
			.section-footer {
				padding: 30px 0;
			}
			.gallery-block .img-block {
				width: calc(calc(100% - 40px) / 3);
			}
			
		}

		@media only screen and (max-width: 530px){
            .remarkable-results-section .btn-group.d-flex.gap-3.flex-wrap.mb-3 {
		        display: grid !important;
		        justify-content: center;
	        }
        }   

		
		@media only screen and (max-width: 450px){
			.private-party-section .main-block:not(:last-of-type) {
				padding-bottom: 0;
			}
			
			.remarkable-results-section .left-block .btn-group a{
				display: block;
				width: 100%;
				text-align: center;
			}
			
			.feats .block p {
				width: calc(100% - 30px);
				font-family: inherit;
				font-size: 16px;
				margin: 0;
			}
			.remarkable-results-section {
				padding: 0;
				margin: 0;
			}
		}
		
		@media only screen and (max-width: 375px){
			.gallery-block .img-block {
				width: calc(calc(100% - 40px) / 2);
			}
			.imgs-block .d-flex .block {
				width: 100%;
			}
		}
    </style>
</head>

<body>
    <section class="remarkable-results-section">
        <div class="camera"><img src="<?php echo get_template_directory_uri()?>/assets/images/brand-new-booth-camera.png" alt="" class="img-fluid"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="left-block">
                        <h3>Real Moments. <span>Remarkable Results.</span></h3>
						<div class="btn-group d-flex gap-3 flex-wrap mb-3">
                           <a href="tel:1300300664" class="primary-btn-outline">
                                call Us                                
							   <svg class="srdev-icon">
                                    <use href="<?php echo get_template_directory_uri()?>/assets/icons.svg#fancy-right-arrow-icom"></use>
                                </svg>
                            </a>
                           <a href="<?php echo get_home_url()?>/contact/" class="primary-btn-outline">
                                Book an Event
							   <svg class="srdev-icon">
                                    <use href="<?php echo get_template_directory_uri()?>/assets/icons.svg#fancy-right-arrow-icom"></use>
                                </svg>
                            </a>
                            <a href="mailto:info@OMGgroup.com.au" class="primary-btn-outline">
                                Email Us
								<svg class="srdev-icon">
                                    <use href="<?php echo get_template_directory_uri()?>/assets/icons.svg#fancy-right-arrow-icom"></use>
                                </svg>
                            </a>
                                        </div>

                        <div class="feats">
                            <div class="d-flex gap-3">
                                <div class="block d-flex align-items-center gap-2 w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-people" viewBox="0 0 16 16">
                                        <path
                                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                                    </svg>
                                    <p>Corporate & Private Events</p>
                                </div>
								
								<div class="block d-flex align-items-center gap-2 w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-lightning-charge" viewBox="0 0 16 16">
                                        <path
                                            d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09zM4.157 8.5H7a.5.5 0 0 1 .478.647L6.11 13.59l5.732-6.09H9a.5.5 0 0 1-.478-.647L9.89 2.41z" />
                                    </svg>
                                    <p>Fast Delivery, Ready to Share</p>
                                </div>
								
								
                                <div class="block d-flex align-items-center gap-2 w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-star" viewBox="0 0 16 16">
                                        <path
                                            d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z" />
                                    </svg>
                                    <p>Premium Quality</p>
                                </div>

                            </div>
                        </div>

                    </div>
                </div> <!-- .col -->

                <div class="col-md-6">
                    <div class="imgs-block">
                        <div class="d-flex gap-2">
                            <div class="block">
                                <div class="img-holder">
                                    <img src="https://creativus-sites.com/demo/dev/omg-studio/wp-content/uploads/2026/06/event-photography-thumbnail.jpg" alt="" class="img-fluid" />
                                    <figcaption>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                                            <path
                                                d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z" />
                                            <path
                                                d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                                        </svg> Event Photography
                                    </figcaption>
                                </div>

                                <div class="text-block text-center d-none">
                                    <h4>Candid Moments,<br> Premium Quality</h4>
                                    <p>Professional coverage of corporate functions, galas, and brand launches.
                                        Capturing every key moment with precision and style.</p>
                                </div>
                            </div> <!-- .block -->


                            <div class="block">
                                <div class="img-holder">
                                    <img src="https://creativus-sites.com/demo/dev/omg-studio/wp-content/uploads/2026/06/videography-photography-img2.jpg" alt="" class="img-fluid" />
                                    <figcaption><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-person-walking" viewBox="0 0 16 16">
                                            <path
                                                d="M9.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0M6.44 3.752A.75.75 0 0 1 7 3.5h1.445c.742 0 1.32.643 1.243 1.38l-.43 4.083a1.8 1.8 0 0 1-.088.395l-.318.906.213.242a.8.8 0 0 1 .114.175l2 4.25a.75.75 0 1 1-1.357.638l-1.956-4.154-1.68-1.921A.75.75 0 0 1 6 8.96l.138-2.613-.435.489-.464 2.786a.75.75 0 1 1-1.48-.246l.5-3a.75.75 0 0 1 .18-.375l2-2.25Z" />
                                            <path
                                                d="M6.25 11.745v-1.418l1.204 1.375.261.524a.8.8 0 0 1-.12.231l-2.5 3.25a.75.75 0 1 1-1.19-.914zm4.22-4.215-.494-.494.205-1.843.006-.067 1.124 1.124h1.44a.75.75 0 0 1 0 1.5H11a.75.75 0 0 1-.531-.22Z" />
                                        </svg> Roaming Photographers</figcaption>

                                </div>

                                <div class="text-block text-center d-none">
                                    <h4>Authentic Reactions,<br> Capture Live</h4>
                                    <p>We blend in, move with your crowd, and capture the real, unscripted moments that
                                        make your event unforgettable.</p>
                                </div>
                            </div> <!-- .block -->


                            <div class="block">

                                <div class="img-holder">
                                    <img src="https://creativus-sites.com/demo/dev/omg-studio/wp-content/uploads/2026/06/videography-photography-img3.jpg" alt="" class="img-fluid" />
                                    <figcaption><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-camera-video" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2zm11.5 5.175 3.5 1.556V4.269l-3.5 1.556zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1z" />
                                        </svg> Event Videography</figcaption>

                                </div>
                                <div class="text-block text-center d-none">
                                    <h4>Your Event, <br> Directed by the Best</h4>
                                    <p>Cinematic storytelling, expert editing, and social-ready content that brings your
                                        event to life - on any platform.</p>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>
            </div>

            <div class="gallery-block">
                <div class="d-flex gap-2 flex-wrap justify-content-center">
                    <div class="img-block">
                        <img src="<?php echo esc_url( home_url() ); ?>/wp-content/uploads/2026/07/omg-gallery-new-photo-1.jpg" alt="" class="img-fluid" />
                    </div>

                    <div class="img-block">
                        <img src="<?php echo esc_url( home_url() ); ?>/wp-content/uploads/2026/07/people-taking-photos-400-500.jpg" alt="" class="img-fluid" />
                    </div>

                    <div class="img-block">
                        <img src="https://creativus-sites.com/demo/dev/omg-studio/wp-content/uploads/2026/06/videography-photography-img4.jpg" alt="" class="img-fluid" />
                    </div>

                    <div class="img-block">
                        <img src="https://creativus-sites.com/demo/dev/omg-studio/wp-content/uploads/2026/06/videography-photography-img5.jpg" alt="" class="img-fluid" />
                    </div>

                    <div class="img-block">
                        <img src="https://creativus-sites.com/demo/dev/omg-studio/wp-content/uploads/2026/06/videography-photography-img6.jpg" alt="" class="img-fluid" />
                    </div>

                    <div class="img-block">
                        <img src="https://creativus-sites.com/demo/dev/omg-studio/wp-content/uploads/2026/06/videography-photography-img7.jpg" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
        </div>

        <div class="section-footer">
            <div class="container">
                <div class="row">
                    <div class="d-flex flex-wrap gap-5 align-items-center">
                        <div class="footer-item d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-patch-check" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M10.354 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                <path
                                    d="m10.273 2.513-.921-.944.715-.698.622.637.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01.622-.636a2.89 2.89 0 0 1 4.134 0l-.715.698a1.89 1.89 0 0 0-2.704 0l-.92.944-1.32-.016a1.89 1.89 0 0 0-1.911 1.912l.016 1.318-.944.921a1.89 1.89 0 0 0 0 2.704l.944.92-.016 1.32a1.89 1.89 0 0 0 1.912 1.911l1.318-.016.921.944a1.89 1.89 0 0 0 2.704 0l.92-.944 1.32.016a1.89 1.89 0 0 0 1.911-1.912l-.016-1.318.944-.921a1.89 1.89 0 0 0 0-2.704l-.944-.92.016-1.32a1.89 1.89 0 0 0-1.912-1.911z" />
                            </svg>
                            <p>experienced<br>professional</p>
                        </div>
                        <div class="footer-item d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-camera" viewBox="0 0 16 16">
                                <path
                                    d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z" />
                                <path
                                    d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                            </svg>
                            <p>modern<br>equipment</p>
                        </div>
                        <div class="footer-item d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-stopwatch" viewBox="0 0 16 16">
                                <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z" />
                                <path
                                    d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64l.012-.013.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3" />
                            </svg>
                            <p>fast <br>turnaround</p>
                        </div>
                        <div class="footer-item d-flex align-items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-shield-check" viewBox="0 0 16 16">
                                <path
                                    d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56" />
                                <path
                                    d="M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                            </svg>
                            <p>reliable <br> professional</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>