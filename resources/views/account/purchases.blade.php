@extends('layouts.app')

@section('content')
<div class="container-fluid app-wapper profile purchases">  
  <div class="app-section app-reveal-section align-items-center">
    <div class="top-bg-image"></div>
      <svg class="Path_10666" viewBox="143.241 204.635 690.685 330.511">
      <path fill="rgba(218,225,229,1)" id="Path_10666" d="M 794.2346801757813 263.7075805664063 L 653.8280029296875 369.6185302734375 C 653.7975463867188 335.0404663085938 642.9666137695313 300.1841430664063 620.5549926757813 270.4426879882813 C 565.63134765625 197.556640625 462.0213623046875 182.995361328125 389.1353759765625 237.9188385009766 C 389.1270446777344 237.9249725341797 389.119384765625 237.9326019287109 389.1094055175781 237.9395294189453 L 389.1086120605469 237.9387359619141 L 143.240966796875 423.4013671875 L 182.9316101074219 476.0725708007813 L 323.3382568359375 370.1632080078125 C 323.3689575195313 404.7398071289063 334.2004089355469 439.5968627929688 356.611572265625 469.3375854492188 C 411.5350036621094 542.2235717773438 515.1456298828125 556.7848510742188 588.0309448242188 501.8613891601563 L 833.925537109375 316.3788452148438 L 794.2346801757813 263.7075805664063 Z M 550.591796875 452.1780395507813 C 505.1453247070313 486.4237060546875 440.5414733886719 477.3448486328125 406.2949523925781 431.8983154296875 C 372.0491027832031 386.4526977539063 381.1289367675781 321.84814453125 426.5745544433594 287.6022338867188 C 472.02099609375 253.3556976318359 536.62548828125 262.4356079101563 570.8715209960938 307.8818969726563 C 605.1171875 353.3275756835938 596.0374145507813 417.9321899414063 550.591796875 452.1780395507813">
      </path>
    </svg>
    <div class="container">
      <div class="page-title">{{ trans('pages.Purchases') }}</div>    

      <div class="app-section purchase-items">
        <div class="purchase-item">
          <svg class="Shape_tv" viewBox="0.5 35.499 1434 1">
            <path fill="transparent" stroke="rgba(218,225,229,1)" stroke-width="1px" stroke-linejoin="miter" stroke-linecap="butt" stroke-miterlimit="4" shape-rendering="auto" id="Shape_tv" d="M 0.5 35.49900054931641 L 1434.5 35.49900054931641">
            </path>
          </svg>
          <div class="row">
            <div class="col col-1">
              <div class="date-label">02/02/2007</div>
            </div>
            <div class="col col-5">
              <div class="item-title">Satellite imagery of buildings and roads </div>
              <div class="item-location">Belgium</div>
              <div class="field-table">
                <div class="row field-row">
                  <div class="col col-4 field-label">Format:</div>
                  <div class="col col-8 field-value">API flow</div>
                </div>
                <div class="row field-row">
                  <div class="col col-4 field-label">Price:</div>
                  <div class="col col-8 field-value">€500</div>
                </div>
                <div class="row field-row">
                  <div class="col col-4 field-label">Access to this data:</div>
                  <div class="col col-8 field-value">1 day<span style="font-weight:normal;"> (From 02/02/2007 until 03/02/2007)</span></div>
                </div>
              </div>
            </div>
            <div class="col col-3 seller">
              <div class="seller-company">Seller company name</div>
              <div class="seller-price">€500 </div>
            </div>
            <div class="col col-3"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
