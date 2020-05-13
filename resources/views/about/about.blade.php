@extends('layouts.app')

@section('title', 'About Databroker | Databroker ')
@section('description', 'Databroker is the blockchain-based, peer-to-peer marketplace for data. Discover how we connect data buyers and sellers to create real business value from data.')

@section('content')
<div id="background-image-mobile"></div>
<div class="container-fluid app-wapper about">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section align-items-center">
            <div class="blog-header mgt60">
                <h1>About Databroker</h1>
                <div class="para">Databroker is the blockchain-based, peer-to-peer marketplace for data. It’s home to an ever-growing number of data buyers and providers worldwide, all with one common goal: to create real business value from data. </div>
            </div>  
            <div class="divider-green mgt30"></div>
            <div class="blog-content">
                <div class="row">
                    <div class="col-lg-8">
                        <div>
                            <h2 class="text-bold">Connecting and serving</h2>
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
                            <h2 class="text-bold">Personalised DataMatch service</h2>
                            <p class="para">
                                For those who have trouble finding the data they need, we offer a tailor-made DataMatch service. Based on your specific needs, our DataMatch Advisor searches for potential data partners from our wide global network, and contacts you when they find what you need. At no extra cost.
                            </p>
                            <!-- <a href="{{ route('contact_pass') }}"><span class="color-green">Discover our DataMatch service</span></a> -->
                            <a href="{{ route('about.matchmaking') }}"><span class="color-green">Discover our DataMatch service</span></a>
                        </div>
                        <div>
                            <h2 class="text-bold">Platform-as-a-Service solution (Paas)</h2>
                            <p class="para">
                                Databroker is also available as white-labeled Platform-as-a-Service solution (PaaS), allowing data-rich companies to achieve, and even exceed their business ambitions by operating their own data exchange platform.
                            </p>
                            <a href="{{ route('contact_pass') }}"><span class="color-green">Interested in finding out about our PaaS solution?</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

<div class="container-fluid app-wapper" id="container-responsive-about">
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
                                    <div class="h3 color-green" id="f-color-green">2016</div>
                                    <div class="h1-small color-blue f" >Creation of Databroker</div>
                                    <p class="para f">The idea behind Databroker originates within SettleMint, its sister company, in Belgium in late 2016. The team, led by two tech visionaries Matthew Van Niekerk and Roderik van der Veer, starts work on a proof-of-concept based on SettleMint’s low-code blockchain middleware.</p>
                                </div>
                            </div>
                            <div id="hn17" class="history-node small right">
                                <svg class="timeline small">
                                    <ellipse fill="rgba(255,255,255,1)" stroke="#2643A0" stroke-width="5px" stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" shape-rendering="auto" rx="10" ry="10" cx="10" cy="10">
                                    </ellipse>                            
                                </svg>
                                <div class="history-line"></div>
                                <div id="chb18" class="history-block ">
                                    <div class="h3 color-green">2017</div>
                                    <div class="h1-small color-blue s">Alpha release, DTX tokens</div>
                                    <p class="para s">A prototype of DataBroker DAO, “the first global marketplace for trading local IoT data”, sees the light of day. Platform validation with end users in Europe, the Middle East and Asia. DTX token sale – a total of 225 million DTX tokens are created, corresponding to the expected number of sensors that will be connected to DataBroker DAO in the year 2024.</p>
                                </div>
                            </div>
                            <div id="hn18" class="history-node small left">
                                <svg class="timeline small">
                                    <ellipse fill="rgba(255,255,255,1)" stroke="#5097B8" stroke-width="5px" stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" shape-rendering="auto" rx="10" ry="10" cx="10" cy="10">
                                    </ellipse>                            
                                </svg>
                                <div class="history-line"></div>
                                <div id="chb19" class="history-block ">
                                    <div class="h3 color-green" id="t-color-green">2018</div>
                                    <div class="h1-small color-blue t">Beta release</div>
                                    <p class="para t">The next release of Databroker DAO sees DTX tokens being staked to ensure the quality of data being sold, and allows potential buyers to easily search and find the sensor data they need and purchase it with DTX tokens. Building DataBroker DAO alliances: Ericsson 5G Life Campus, Rivetz...</p>
                                </div>
                            </div>
                            <div id="hn19" class="history-node small right">
                                <svg class="timeline small">
                                    <ellipse fill="rgba(255,255,255,1)" stroke="#78E6D0" stroke-width="5px" stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" shape-rendering="auto" rx="10" ry="10" cx="10" cy="10">
                                    </ellipse>                            
                                </svg>
                                <div class="history-line"></div>
                                <div id="chb20" class="history-block ">
                                    <div class="h3 color-green" id="fo-color-green">2019</div>
                                    <div class="h1-small color-blue fo">Revisioning, rebranding and retooling</div>
                                    <p class="para fo">In a year full of transformation, Databroker DAO is rebranded as Databroker, the scope is extended from IoT data to all kinds of data, and the whole concept is redesigned to convey the new message: Databroker is the marketplace for data. The team focuses on building the platform and onboarding new partners that share our vision.</p>
                                </div>
                            </div>
                            <div id="hn20" class="history-node small left">
                                <svg class="timeline small">
                                    <ellipse fill="rgba(255,255,255,1)" stroke="#78E6D0" stroke-width="5px" stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" shape-rendering="auto" rx="10" ry="10" cx="10" cy="10">
                                    </ellipse>                            
                                </svg>
                                <div class="history-line"></div>
                                <div id="chb20" class="history-block ">
                                    <div class="h3 color-green" id="fi-color-green">2020</div>
                                    <div class="h1-small color-blue fi">Commercial release</div>
                                    <p class="para fi">The first commercial version of the marketplace for data is launched.</p>
                                    <p class="para fi">Data buyers and sellers can connect via the Databroker platform and exchange data securely on a peer-to-peer basis.</p>
                                    <p class="para fi">For buyers who have trouble finding the data they need, our free, tailor-made DataMatch service helps identify and match potential data partners from our wide global network.</p>
                                    <p class="para fi">And data-rich organizations like network operators, network service enablers and smart cities can leverage our white-labeled Platform-as-a-Service (PaaS) solution to operate their own data exchange platforms for public and private data sharing.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="sub-footer container-fluid app-wapper">
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
                            <a class="icon-wrapper flex-center mg15" href="{{ $member['linkedin'] }}" target="_blank"><div class="databroker-icon linkedin"></div></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sub-footer container-fluid app-wapper" id="about-page-mobile">
    <div class="container">
        <div class="flex-vertical flex-vcenter">
            <div class="divider-green"></div>
            <div class="h2 mgt30">Don't miss any updates!</div>
            <div class="">Sign up to our newsletter</div>
            <a href="{{route('register_nl')}}"><button class="button customize-btn mgt60">SIGN UP</button></a>
        </div>
    </div>
</div>   

@endsection

