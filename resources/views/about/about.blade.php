@extends('layouts.app')

@section('content')
<div class="container-fluid app-wapper about">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section align-items-center">
            <div class="blog-header mgt60">
                <div class="h1-small">About Databroker</div>
                <div class="para">Databroker is the blockchain-based, peer-to-peer marketplace for data. It’s home to an ever-growing number of data buyers and providers worldwide, all with one common goal: to create real business value from data. </div>
            </div>  
            <div class="divider-green mgt30"></div>
            <div class="blog-content">
                <div class="row">
                    <div class="col-lg-8">
                        <div>
                            <div class="h3">Connecting and serving</div>
                            <p class="para">
                                Responding to the needs of our data-driven age, Databroker is there to connect and serve, whatever the size of your organisation or company, and whatever your data needs.
                            </p>
                            <p class="para">
                                Via our platform, you can buy or sell pre-defined data streams or data sets, or find your ideal data partner through broader offers and requests that can be fine-tuned and negotiated. 
                            </p>
                            <p class="para">
                                And thanks to blockchain technology, purchased data is safely and securely transferred directly between the two parties, never touching the Databroker platform. This automated process offers speed and reliability, and gives unparalleled assurances about data integrity.
                            </p>
                        </div>
                        <div>
                            <div class="h3">Personalised DataMatch service</div>
                            <p class="para">
                                For those who have trouble finding the data they need, we offer a tailor-made DataMatch service. Based on your specific needs, our DataMatch Advisor searches for potential data partners from our wide global network, and contacts you when they find what you need. At no extra cost.
                            </p>
                            <a href="javascript;"><span class="color-green">Discover our DataMatch service</span></a><!-- Link to 40_Matchmaking service -->
                        </div>
                        <div>
                            <div class="h3">Platform-as-a-Service solution (Paas)</div>
                            <p class="para">
                                Databroker is also available as white-labeled Platform-as-a-Service solution (PaaS), allowing data-rich companies to achieve, and even exceed their business ambitions by operating their own data exchange platform.
                            </p>
                            <a href="javascript;"><span class="color-green">Interested in finding out about our PaaS solution?</span></a><!-- Link to 110_Contact -->
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>
<div class="container-fluid app-wapper">
    <div class="section_splitor_green"></div>
    <div class="container">
        <div class="app-section flex-vcenter flex-vertical story-section">
            <div class="divider-green mgt30"></div>
            <div class="h2 section-title">Our story</div>
            <div class="history-container">
                <div class="col-history-connectors-layer">
                    <div class="col-history-connectors">
                        <div class="history-connector-wrapper flex-vcenter flex-vertical">
                            <div class="history-connector solid"></div>
                            <div class="history-connector dot"></div>
                            <div class="history-connector arrow"></div>
                        </div>
                    </div>
                    <div class="history-node-wrapper col-mid-timeline">
                        <div id="hn16" class="history-node big left">
                            <svg class="timeline big">
                                <ellipse fill="rgba(255,255,255,1)" stroke="rgba(6,3,141,1)" stroke-width="5px" stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" shape-rendering="auto" rx="15" ry="15" cx="15" cy="15">
                                </ellipse>                            
                            </svg>
                            <div class="history-line"></div>
                            <div id="chb16" class="history-block ">
                                <div class="h3 color-green">It started in 2016</div>
                                <div class="h1-small color-blue">Creation of Databroker</div>
                                <p class="para">The idea behind Databroker originates within SettleMint, its sister company, in late 2016. The team starts work on a proof-of-concept based on SettleMint’s low-code blockchain platform.</p>
                            </div>
                        </div>
                        <div id="hn18" class="history-node small right">
                            <svg class="timeline small">
                                <ellipse fill="rgba(255,255,255,1)" stroke="#2643A0" stroke-width="5px" stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" shape-rendering="auto" rx="10" ry="10" cx="10" cy="10">
                                </ellipse>                            
                            </svg>
                            <div class="history-line"></div>
                            <div id="chb18" class="history-block ">
                                <div class="h3 color-green">2018</div>
                                <div class="h1-small color-blue">V1 Protoype, DXT tokens</div>
                                <p class="para">The first prototype of DataBroker DAO, the first global data marketplace for trading data, sees the light of day in 2018. A total of 225 million DTX tokens are created, corresponding to the expected number of sensors that will be connected to DataBroker DAO in the year 2024.</p>
                            </div>
                        </div>
                        <div id="hn19" class="history-node small left">
                            <svg class="timeline small">
                                <ellipse fill="rgba(255,255,255,1)" stroke="#5097B8" stroke-width="5px" stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" shape-rendering="auto" rx="10" ry="10" cx="10" cy="10">
                                </ellipse>                            
                            </svg>
                            <div class="history-line"></div>
                            <div id="chb19" class="history-block ">
                                <div class="h3 color-green">2019</div>
                                <div class="h1-small color-blue">V2 Alpha release</div>
                                <p class="para">The next release of Databroker DAO sees DTX tokens being staked to ensure the quality of data being sold, and allows potential buyers to easily search and find the sensor data they need and purchase it with DTX tokens.</p>
                            </div>
                        </div>
                        <div id="hn20" class="history-node small right">
                            <svg class="timeline small">
                                <ellipse fill="rgba(255,255,255,1)" stroke="#78E6D0" stroke-width="5px" stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" shape-rendering="auto" rx="10" ry="10" cx="10" cy="10">
                                </ellipse>                            
                            </svg>
                            <div class="history-line"></div>
                            <div id="chb20" class="history-block ">
                                <div class="h3 color-green">2020</div>
                                <div class="h1-small color-blue">V3 Commercial release</div>
                                <p class="para">2020 sees the rebranding of the Databroker platform, and the first commercial version of the marketplace where data buyers and data sellers can meet each other autonomously. Ongoing focus is on onboarding of data sellers and gaining commercial traction.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sub-footer container-fluid app-wapper">
    <div class="section_splitor_gray"></div>
    <div class="container">
        <div class="blog-section">
            <div class="flex-vertical flex-vcenter">
                <div class="divider-green mgt60"></div>
                <div class="h2 mgb40">The team</div>
                <div class="teammembers row mgb40">
                    @foreach ($teammates as $member)
                    <div class="cell member col-lg-3 col-sm-6 col-xs-6 flex-vertical flex-vcenter text-center mgt40 mgb40">
                            <div class="partner-logo avatar square-xs" style="background-image: url('{{asset($member['avatar'])}}');"></div>
                            <div class="name mgt25">{{$member['name']}}</div>
                            <div class="teamtitle para-small">{{$member['title']}}</div>
                            <div class="spacer"></div>
                            <a class="icon-wrapper flex-center mg15"><div class="databroker-icon linkedin"></div></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sub-footer container-fluid app-wapper">
    <div class="section_splitor_gray h713 mgb80"></div>
    <div class="container">
        <div class="flex-vertical flex-vcenter">
            <div class="divider-green"></div>
            <div class="h2 mgt30">Dont' miss any updates!</div>
            <div class="">Sign up to our newsletter</div>
            <button class="button customize-btn mgt60">SIGN UP</button>
        </div>
    </div>
</div>   

@endsection

