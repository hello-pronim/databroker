@extends('layouts.app')

@section('content')
<div class="container-fluid app-wapper about">
    <div class="bg-pattern1-left"></div>
    <div class="container">
        <div class="app-section align-items-center">
            <div class="blog-header mgt60">
                <div class="h1-small">About Databroker</div>
            </div>  
            <div class="divider-green mgt30"></div>
            <div class="blog-content">
                <div class="row">
                    <div class="col-lg-8">
                        <p class="para">Whether you want to buy or sell business data, Databroker’s peer-to-peer marketplace for data brings together everything you need for a winning match:</p>
                        <ul class="databroker-list">
                            <li>Easy access to large communities of data buyers and sellers</li>
                            <li>One platform to manage all aspects of your data transactions</li>
                            <li>Guaranteed security, reliability and privacy thanks to blockchain technology</li>
                        </ul>
                        <p class="para">Buy or sell pre-defined data streams or data sets or find your ideal data partner through broader offers and requests that can be fine-tuned and negotiated. Our platform is there to connect and serve real business value, whatevfer the size of your organisation or company, whatever your data needs.</p>
                        <p class="para">We’re also launching an additional service, where our very own <b>DataMatch Advisor</b> can offer a personalised ‘data matchmaking’ service. Based on your specific needs, we search for potential data partners from our wide global network, and contact you when we’ve found what you need. At no extra cost.</p>
                        <p class="para">Databroker is also available as <b>Platform-as-a-Service solution (Paas)</b>. Our platform is there to connect and serve, whatever the size of your organization or company, whatever your business needs. Adopting Databroker as a white-label platform can help companies achieve, and even exceed their business needs.</p>
                    </div>
            </div>
        </div>  
    </div>
</div>
<div class="container-fluid app-wapper">
    <div class="section_splitor_green"></div>
    <div class="container">
        <div class="app-section flex-vcenter flex-vertical">
            <div class="divider-green mgt30"></div>
            <div class="h2">Our story</div>
            <div class="history-container row mgt60">
                <div class="col-lg-4 col-full-left">
                    <div id="hb16" class="history-block ">
                        <div class="h3 color-green">It started in 2016</div>
                        <div class="h1-small color-blue">Creation of Databroker</div>
                        <p class="para">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar sic tempor.</p>
                    </div>
                    <div id="hb19" class="history-block ">
                        <div class="h3 color-green">2019</div>
                        <div class="h1-small color-blue">V2 Alpha release</div>
                        <p class="para">Ensure the quality of data being sold and purchased, allow potential buyers to search easily and find the data they need and purchase sensor data with DTX tokens.</p>
                    </div>
                </div>
                <div class="col-lg-4 flex-vcenter flex-vertical mgh60">
                    <div class="history-connector-wrapper flex-vcenter flex-vertical">
                        <div class="history-connector solid"></div>
                        <div class="history-connector dot"></div>
                        <div class="history-connector arrow"></div>
                    </div>
                    <div class="history-node-wrapper flex-vcenter flex-vertical">
                        <div id="hn16" class="history-node big flex-vcenter">
                            <svg class="timeline big">
                                <ellipse fill="rgba(255,255,255,1)" stroke="rgba(6,3,141,1)" stroke-width="5px" stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" shape-rendering="auto" rx="15" ry="15" cx="15" cy="15">
                                </ellipse>                            
                            </svg>
                            <div class="history-line left"></div>
                        </div>
                        <div id="hn18" class="history-node small flex-vcenter">
                            <svg class="timeline small">
                                <ellipse fill="rgba(255,255,255,1)" stroke="#2643A0" stroke-width="5px" stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" shape-rendering="auto" rx="10" ry="10" cx="10" cy="10">
                                </ellipse>                            
                            </svg>
                            <div class="history-line right"></div>
                        </div>
                        <div id="hn19" class="history-node small flex-vcenter">
                            <svg class="timeline small">
                                <ellipse fill="rgba(255,255,255,1)" stroke="#5097B8" stroke-width="5px" stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" shape-rendering="auto" rx="10" ry="10" cx="10" cy="10">
                                </ellipse>                            
                            </svg>
                            <div class="history-line left"></div>
                        </div>
                        <div id="hn20" class="history-node small flex-vcenter">
                            <svg class="timeline small">
                                <ellipse fill="rgba(255,255,255,1)" stroke="#78E6D0" stroke-width="5px" stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" shape-rendering="auto" rx="10" ry="10" cx="10" cy="10">
                                </ellipse>                            
                            </svg>
                            <div class="history-line right"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div id="hb18" class="history-block ">
                        <div class="h3 color-green">2018</div>
                        <div class="h1-small color-blue">V1 Protoype, DXT tokens</div>
                        <p class="para">Launch of DataBroker DAO, the first global data marketplace for trading data. Creation of 225 million DTX tokens which corresponds to the expected number of sensors that will be connected to DataBroker DAO in the year 2024.</p>
                    </div>
                    <div id="hb20" class="history-block ">
                        <div class="h3 color-green">2020</div>
                        <div class="h1-small color-blue">V3 Commercial release</div>
                        <p class="para">Rebranding and first commercial version where data buyers and data sellers are able to meet each other autonomously. Onboarding of data sellers and confirmation of the market commercial traction.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="sub-footer" class="sub-footer container-fluid">
        <div class="section_splitor_gray"></div>
        <div class="blog-section">
            <div class="container flex-vertical flex-vcenter">
                <div class="divider-green mgt60"></div>
                <div class="h2 mgb80">The team</div>
                <div class="teammembers mgb80">
                    @foreach ($teammates as $member)
                    <div class="cell member flex-vertical flex-vcenter">
                        <div class="partner-logo avatar" style="background-image: url('{{asset($member['avatar'])}}');"></div>
                        <div class="name">{{$member['name']}}</div>
                        <div class="teamtitle para-small">{{$member['title']}}</div>
                        <a class="icon linkedin"></a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="section_splitor_gray h713 mgb80"></div>
        <div class="container flex-vertical flex-vcenter">
            <div class="divider-green"></div>
            <div class="h2 mgt30">Dont' miss any updates!</div>
            <div class="">Sign up to our newsletter</div>
            <button class="button customize-btn mgt60">SIGN UP</button>
        </div>
    </div>   
</div>

@endsection

