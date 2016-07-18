<?php echo $header; ?>
<link rel="stylesheet" type="text/css" href="view/stylesheet/order_volusion.css" />
<div id="content" class="volusion-style">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="warning" style="display: none;"></div>
  <div id="pagelabel">
    <span id="print_pagename">Order <?php echo $order_id?></span>
    <span class="v13-titlenote order-placedon"><span title="Placed On: <?php echo $date_added?>"><strong>Placed:</strong> <?php echo $date_added?></span></span>
    <span class="v13-titlenote order-lastmodified" title="Modified: <?php echo $date_modified?>  by <?php echo $firstname . ' ' . $lastname?>"><strong>Modified:</strong> <?php echo $date_modified?>  by <?php echo $firstname . ' ' . $lastname?></span>
    <span id="print_pagesubnav"><span class="separator">|&nbsp;</span></span>
  </div>
  <form action="" method="POST" id="order_form">
    <input type="hidden" name="customer_id" value="<?php echo $customer_id?>">
    <table class="table-statusandquickjump">
      <tbody>
        <tr>
          <td class="cell-status">
            <span class="label-inline">Status</span>
            
            <select id="order_status_id" class="statusselect" name="order_status_id" onchange="ShowSave();">
              <?php foreach($order_statuses as $status) { ?>
                <option value="<?php echo $status['order_status_id']?>" <?php echo $status['order_status_id']==$order_status_id ? "selected":""?>><?php echo $status['name']?><?php echo ($status['order_status_id']==$order_status_id && $date_shipped) ? (' ' . date('m/d/Y h:iA', strtotime($date_shipped))):'' ?></option>
              <?php } ?>
            </select>
            
            <?php if(!$date_shipped) { ?>
            <a href="<?php echo $act_complete_order . '&amp;email='.$email.'&amp;order_id='.$order_id?>" class="v13-button-primary">Complete Order</a>
            <?php } else { ?>
            <a href="javascript:void(0);" class="v13-button-secondary v13-button-check"><span class="v13-icon-check"></span>Order Complete</a>
            <?php } ?>
          </td>
          
          <td class="cell-nextprevious">            
            <table>
              <tbody><tr>
                <td>
                  Quick Jump&nbsp;&nbsp;
                </td>
                <td class="cell-quickjump">
                  <input type="text" class="input-quickjump" name="order_jump_field" id="order_jump_field" autocomplete="off" style="width: 50px;" value="<?php echo $order_id?>"><a onclick="window.location.href='<?php echo $act_jump?>&order_id='+$('#order_jump_field').val();" href="javascript:" class="v13-button-secondary">Go</a>
                </td>

                <script type="text/javascript">
                    $('#order_jump_field').keypress(function (e) {
                        if (e.which == "13") {
                            e.preventDefault();
                            window.location.href = '<?php echo $act_jump?>&order_id=' + $(this).val();
                        }
                    });
                </script>
              
                <td class="cell-prevlistnext">
                  <span class="v13-combobutton-secondary">

                    <a href="<?php echo $act_jump . '&order_id=' . ($order_id-1)?>" class="notext"><span class="v13-icon-previous">previous</span></a>
                    <a href="<?php echo $act_list?>" class="notext"><span class="v13-icon-list">list</span></a>
                    <a href="<?php echo $act_jump . '&order_id=' . ($order_id+1)?>" class="notext"><span class="v13-icon-next">next</span></a>
                  </span>
                </td>
              </tr>
            </tbody></table>
          </td>
        </tr>
      </tbody>
    </table>

    <table class="table-orderdetails summary">
      <tbody>
        <tr valign="top">
          <td class="cell-totalandfraudwrapper">
            <table class="table-totalandfraud">
              <tbody><tr>
                <td class="cell-fraudenabled">
                  <table class="table-standard">
                    <tbody><tr>
                      <td class="cell-ordertotallabel">
                        <div>
                          <span class="summary subheading">Order Total</span></div>
                      </td>
                      <td class="cell-fraudtotallabel">
                        
                        <div>
                          <span class="summary subheading">Fraud Score</span>
                        </div>
                        
                      </td>
                    </tr>
                    <tr>
                      <td class="cell-ordertotal">
                        <div id="dynordertotal"><span class="summarygrandtotal" style="padding-right:0px;"><?php echo $total?></span></div>
                      </td>
                      <td class="cell-fraudtotal">
                        
                        <div class="fraudriskandactionlinkswrapper">
                          <table>
                            <tbody><tr>
                              <td>
                                <div id="fraudrisk">
                                </div>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                
                                <span>Unavailable with PHONE Orders</span>
                                                            
                              </td>
                            </tr>
                          </tbody></table>
                        </div>
                        
                      </td>
                    </tr>
                  </tbody></table>
                  
                  <div class="customerdetailswrapper">
                    
                    <p>
                      <b>Customer ID#:</b>&nbsp;
                      <?php if($customer_id > 0) { ?>
                      <a href="<?php echo $act_customer . '&customer_id='.$customer_id?>" target="_customer_edit"><?php echo $customer_id?></a>
                      <?php } else { ?>
                      Not Registered
                      <?php } ?>
                      placed <span class="blue"><a href="javascript:;">1 orders</a></span> totaling <span class="green">$1,257.59</span>.
                    </p>

                    <p>This order was placed via <?php echo $user_agent?>
                      <!-- default show the ip note and link -->
                      via IP Address <a onclick="return confirm('Clicking OK will navigate you away from this site. We cannot be responsible for the content of the visiting site.');" class="externalLinkBlue" href="http://whois.domaintools.com/<?php echo $ip?>" target="_blank" title="Click to perform a WHOIS search for this IP"><?php echo $ip?></a>.
                    </p>
                  </div>
                </td>
              </tr>
            </tbody></table>
            <div>
              <table class="table-billingandshipping">
                <tbody>
                  <tr valign="top">
                    <td>                
                      <div>
                        <span class="customer_title">Billing
                          <?php if($customer_id > 0) { ?>
                          <a class="actionlink" href="<?php echo $act_customer . '&customer_id='.$customer_id?>" target="_customer_edit">Edit</a>&nbsp;|
                          <?php } ?>
                          <span class="map"><a href="http://maps.google.com/maps?f=q&amp;hl=en&amp;geocode=&amp;q=<?php echo $payment_address_1 . ' ' . $payment_address_2 . '+' . $payment_city . ',+' . $payment_zone . '+' . $payment_postcode?>+&amp;ie=UTF8&amp;iwloc=addr" target="_blank" class="externalLinkBlue actionlink">Map It</a></span> </span>
                      </div>
                      <p>
                        <?php echo $payment_company?><br>
                        <?php echo $payment_firstname?>&nbsp;<?php echo $payment_lastname?><br>
                        <?php echo $payment_address_1?>&nbsp;<?php echo $payment_address_2?><br>
                        <?php echo $payment_city?>,
                        <?php echo $payment_zone?>&nbsp;<?php echo $payment_postcode?><br>
                        <?php echo $payment_country?><br>
                        <?php echo $telephone?><br>
                        <a href="mailto:<?php echo $email?>?subject=RE: proaudiola.com : Order %23<?php echo $order_id?>">
                          <?php echo $email?></a>
                      </p>              
                    </td>
                    <td>
                      <div>
                        <span class="customer_title">Shipping
                          <?php if($customer_id > 0) { ?>
                          <a class="actionlink" href="<?php echo $act_customer . '&customer_id='.$customer_id?>" target="_customer_edit">Edit</a>&nbsp;|
                          <?php } ?>
                          <span class="map"><a href="http://maps.google.com/maps?f=q&amp;hl=en&amp;geocode=&amp;q=<?php echo $shipping_address_1 . ' ' . $shipping_address_2 . '+' . $shipping_city . ',+' . $shipping_zone . '+' . $shipping_postcode?>&amp;ie=UTF8&amp;iwloc=addr" target="_blank" class="externalLinkBlue actionlink">Map It</a> </span>
                        </span>
                      </div>
                      <p>
                        <?php echo $shipping_company?><br>
                        <?php echo $shipping_firstname?>&nbsp;<?php echo $shipping_lastname?><br>
                        <?php echo $shipping_address_1?>&nbsp;<?php echo $shipping_address_2?><br>
                        <?php echo $shipping_city?>,
                        <?php echo $shipping_zone?>&nbsp;<?php echo $shipping_postcode?><br>
                        <?php echo $shipping_country?><br>
                        <?php echo $telephone?><br>
                        <a href="mailto:<?php echo $email?>?subject=RE: proaudiola.com : Order %23<?php echo $order_id?>">
                          <?php echo $email?></a>
                      </p>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </td>
          <td valign="top" align="left">
            <div>
              <table class="table-standard">
                <tbody><tr valign="middle">
                  <td class="cell-printheading">
                    <span class="customer_title gray">Print</span>
                  </td>
                </tr>
                <tr valign="middle">
                  <td class="printerarea">
                    <ul>
                      
                      <li><a class="externalLinkBlue" href="javascript:;" target="_blank">Invoice</a></li>
                      <li><a class="externalLinkBlue" href="javascript:;" target="_blank">Packing Slip</a></li>
                      <li id="gift_certificate_item"></li>
                    </ul>
                  </td>
                </tr>
              </tbody></table>
            </div>
            <div class="shippingWrapper">
              <table class="table-standard">
                <tbody><tr valign="middle">
                  <td class="printerarea">
                    <ul>
                      <li><a href="javascript:;">FedEx</a>&nbsp;&nbsp;&nbsp;&nbsp;|</li>
                      <li><a href="javascript:;">DHL</a>&nbsp;&nbsp;&nbsp;&nbsp;|</li>
                      <li><a href="javascript:;">USPS</a>&nbsp;&nbsp;&nbsp;&nbsp;|</li>
                      <li><a href="javascript:;">Address</a></li>
                    </ul>
                  </td>
                </tr>
              </tbody></table>
            </div>
            <hr noshade="noshade" class="hrule-standard">
            <div class="emailWrapper">
              <table class="table-standard">
                <tbody><tr valign="middle">
                  <td class="cell-emailoptions">
                    <span class="label-inline">Email</span>
                    <select name="PreDefinedEmails">
                      <option value="">Select</option>
                      <option value="Shipped">Shipped</option>
                      <option value="Partially_Shipped">Partially Shipped</option>
                      <option value="Invoice_Customer">Invoice (to Customer)</option>
                      <option value="Invoice_Vendor">Invoice (to Merchant)</option>
                      <option value="Product_Keys">Product Keys</option>
                      <option value="Gift_Certificates">Gift Certificates</option>
                    </select>
                    <div style="display: none;">
                      <input type="submit" value="Send" name="Send_PreDefinedEmails" id="Send_PreDefinedEmails">
                    </div>
                    <a style="margin-left: 10px;" href="javascript:void(0);" class="v13-button-secondary">Resend</a>
                  </td>
                </tr>
              </tbody></table>
            </div>
            <hr noshade="noshade" align="left" class="hrule-standard">
            <div style="margin-top: 15px; margin-bottom: 15px;">
              <script type="text/javascript">

                function selectFolderMenu(element) {
                  var folderMenuTabs = getFolderMenuTabs(element);
                  var folderMenuContainer = getFolderMenuContainer(folderMenuTabs);
                  var folderMenuContent = getFolderMenuContent(folderMenuContainer);
                  var tabParent = element.parentNode;

                  if (element.className.indexOf('selected') == -1) {
                    element.className += ' selected';
                    element.className = element.className.replace(/tr/g, '');
                    element.className = element.className.replace(/tl/g, '');
                  }

                  var Item = 0;
                  var ItemBorderSwitch = false;
                  for (var i = 0, x = 0, tabPos = 0; i < tabParent.childNodes.length; i++) {
                    var curNode = tabParent.childNodes[i];
                    if (curNode.nodeName.toLowerCase() == 'li') {
                      x++;
                      
                      if (curNode == element) {
                        tabPos = x;
                        ItemBorderSwitch= true;
                      }
                      else {
                        if (curNode.className.indexOf('selected') != -1) {
                          curNode.className = curNode.className.replace(/selected/g, '');
                        }
                        
                        if(!ItemBorderSwitch)
                        {
                          if (curNode.className.indexOf('tr') != -1) {
                            curNode.className = curNode.className.replace(/tr/g, 'tl');
                          }else{
                            curNode.className += ' tl';
                          }
                        }else{
                          if (curNode.className.indexOf('tl') != -1) {
                            curNode.className = curNode.className.replace(/tl/g, 'tr');
                          }else{
                            curNode.className += ' tr';
                          }
                        }
                      }
                      
                      
                    }
                  }
                      
                  for (var i = 0, x = 0; i < folderMenuContent.childNodes.length; i++) {
                    if (folderMenuContent.childNodes[i].nodeName.toLowerCase() == 'div') {
                      x++;
                      if (x == tabPos) {
                        folderMenuContent.childNodes[i].style.display = 'block';
                      }
                      else {
                        folderMenuContent.childNodes[i].style.display = 'none';
                      }
                    }
                  }
                }

                function getFolderMenuTabs(element) {
                  return element.parentNode;
                }

                function getFolderMenuContainer(element) {

                  if (element.className.indexOf('folder_menu_tabs') != -1) {
                    return element.parentNode;
                  }
                  else if (element.className.indexOf('folder_menu_container') != -1) {
                    return element;
                  }
                  else  {
                    return getFolderMenuTabs(element).parentNode;
                  }
                }

                function getFolderMenuContent(element) {

                  var folderMenuContainer = getFolderMenuContainer(element);

                  for (var i = 0; i < folderMenuContainer.childNodes.length; i++) {
                    if (folderMenuContainer.childNodes[i].nodeName.toLowerCase() == 'div') {
                      return folderMenuContainer.childNodes[i];
                    }
                  }
                }

                function selectDefFolderMenu(folderGroupName) {
                  var FolderGroupCookie = GetCookie('vsettings','FolderGroup' + folderGroupName);
                  if (FolderGroupCookie) {
                    document.getElementById(FolderGroupCookie).onclick();
                  }
                }

                function setDefFolderMenu(folderGroupName, element) {
                  SetCookie('vsettings', element.id, 1 * c_years, 'FolderGroup' + folderGroupName);
                }
              </script>

              <div class="folder_menu_container">
                <ul class="v13-tabset" id="ordernotetabs">
                  <li class="v13-tab v13-selected">
                    <a href="javascript:;" data-target="#tab_ordernotes">
                      <?php if($comment) { ?>
                      <span class="v13-icon-notespresent"></span>
                      <?php } else { ?>
                      <span class="hidden"></span>
                      <?php } ?>
                      Order Notes
                    </a>
                  </li>
                  <li class="v13-tab">
                    <a href="javascript:;" data-target="#tab_privatenotes">
                      <?php if($internal_comment) { ?>
                      <span class="v13-icon-notespresent"></span>
                      <?php } else { ?>
                      <span class="hidden"></span>
                      <?php } ?>
                      Private Notes
                    </a>
                  </li>
                  <li class="v13-tab">
                    <a href="javascript:;" data-target="#tab_giftnotes">
                      <?php if($gift_comment) { ?>
                      <span class="v13-icon-notespresent"></span>
                      <?php } else { ?>
                      <span class="hidden"></span>
                      <?php } ?>
                      Gift Notes
                    </a>
                  </li>
                  <li class="v13-tab">
                    <a href="javascript:;" data-target="#tab_account">
                      <?php if($customer_comment) { ?>
                      <span class="v13-icon-notespresent"></span>
                      <?php } else { ?>
                      <span class="hidden"></span>
                      <?php } ?>
                      Account
                    </a>
                  </li>
                </ul>
                <div class="folder_menu_content">
                  <div class="folder_menu_item" id="tab_ordernotes" style="display: block;">
                    <textarea id="comment" name="comment" style="width: 98%; overflow: visible;" rows="6" class="texpand1_small" onchange="ShowSave();" onkeyup="ShowSave();"><?php echo $comment?></textarea>
                  </div>
                  <div class="folder_menu_item" id="tab_privatenotes" style="display: none;">
                    <textarea id="internal_comment" name="internal_comment" style="width: 98%; overflow: visible;" rows="6" class="texpand1_small" onkeyup="ShowSave()" onchange="ShowSave();"><?php echo $internal_comment?></textarea>
                  </div>
                  <div class="folder_menu_item" id="tab_giftnotes" style="display: none;">
                    <textarea id="gift_comment" name="gift_comment" style="width: 98%; overflow: visible;" rows="6" class="texpand1_small" onkeyup="ShowSave()" onchange="ShowSave();"><?php echo $gift_comment?></textarea>
                  </div>
                  <div class="folder_menu_item" id="tab_account" style="display: none;">
                    <?php if($customer_id > 0) { ?>
                    <textarea id="customer_comment" name="customer_comment" style="width: 98%; overflow: visible;" rows="6" class="texpand1_small" onkeyup="ShowSave()" onchange="ShowSave();"><?php echo $customer_comment?></textarea>
                    <?php } else { ?>
                    There are no customer notes
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>

            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    $('#ordernotetabs li a').click(function(e){
                      e.preventDefault();
                      e.stopPropagation();
                      $('#ordernotetabs li').removeClass('v13-selected');
                      $('.folder_menu_content .folder_menu_item').hide();
                      var target = $(this).attr('data-target');
                      $(this).parent('li').addClass('v13-selected');
                      $('.folder_menu_content ' + target).fadeIn(300);
                    });
                });
            </script>
            
          </td>
        </tr>
      </tbody>
    </table>
    <div class="a65chromepanel expanded" id="a65chromepanel_1">
      <div class="a65chromeheader" id="a65chromeheader_1">
        <span class="a65chromeheadertext">
          <span class="arrow_link" id="arrow_link_1">
            <span class="v13-icon-downarrow"></span>
          </span>Payments
        </span>
      </div>
      <div class="a65chromecontent" id="OrderDetails_detail_page_section___detail_page_section_1" style=""><!--line 1000-->
      <table class="table-standard contenttable">
        
        <tbody><tr valign="top">
          

        <td class="cell-paymentsandcredits">
         <table width="100%" border="0">
          <tbody><tr>
          <td>
           <span class="customer_title">Payments &amp; Credits</span>
          </td>
          </tr>
          <tr>
              <td>
           <div class="contentareanoscrollstyle" id="PaymentsAndCredits">

                  <div>

      <table class="table-standard" align="center" cellpadding="5" style="">
        <thead>
          <tr valign="middle">
            <td>
              
              </td>
              <td>
              </td>
            </tr>
            <tr valign="middle">
              <td colspan="2" nowrap="" align="left">
                Current Method&nbsp;<b>(PayPal)</b>

                                CVV2:
                                <input type="text" onchange="ShowSave()" onkeyup="ShowSave()" name="CVV2_Payment" style="width: 30px;" maxlength="4" id="CVV2_Payment">
                                
                              </td>
                            </tr>
                            
                            <tr valign="middle">
                              <td colspan="2" style="white-space: nowrap; text-align: left">
                                <div>
                                  <div style="float: left; padding-top: 2px;">
                                    <select name="Collect_Payment_TransType">
                                      <option value="DEBIT">Debit</option>
                                      
                                    </select>&nbsp;
                                    <input type="text" name="Collect_Payment_Amount" value="0.00" style="width: 75px;">
                                  </div>
                                  
                                  <div style="float: left; margin-left: 10px; margin-top: 2px;">
                                    <a onclick="PerformImpersonatedClickEvent('btnCollectPayment');" href="javascript:void(0);" class="v13-button-primary">Receive</a>
                                  </div>
                                  
                                </div>
                                <div style="display: none">
                                  <font><font><input type="submit" id="btnCollectPayment" name="btnCollectPayment" value="Receive"></font></font></div>
                              </td>
                            </tr>
                            
                            <tr>
                              <td colspan="2" nowrap="" align="left" style="padding-bottom: 15px;">
                              </td>
                            </tr>
                            <tr valign="middle">
                              <td colspan="2" nowrap="" align="left">
                                Change Payment Type
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2" nowrap="" align="left" style="padding-bottom: 15px;">
                                <select onkeyup="ShowSave()" id="PaymentMethodType" name="PaymentMethodType" onchange="HandlePaymentMethods(this)">
                                  <option selected="" value=""><font><font>Select</font></font></option>
                                  <option value="5">Credit Card</option><option value="18">PayPal</option><option value="2">Check by Mail</option><option value="14">Wire Transfer</option><option value="16">Money Order</option><option value="29">QuickSpark Financing</option><option value="28">Synchrony Account</option>
                                  <option value="">-------------------------------</option>
                                  <option value="-1">Offline Payment Record</option>
                                  <option value="-2">Store Credit / Gift Certificate</option>
                                </select>
                                
                                <input type="hidden" id="PCIaaS_CardId_ForReceiveButton" name="PCIaaS_CardId_ForReceiveButton" value="0eef523a849a451fa3d7f480f7c5d42f">
                                <input type="hidden" id="PCIaaS_CardId" name="PCIaaS_CardId" value="">
                                
                              </td>
                            </tr>
                          </thead>
                          
                          <tbody id="ShowFields_CreditCard" style="display: none;">
                            <tr>
                              <td colspan="8">
                                <table>
                                  <tbody><tr>
                                    <td colspan="2">
                                      
                                      <table cellpadding="0" cellspacing="0" border="0" style="margin: 0;">
                                        <tbody><tr>
                                          <td width="39%" nowrap="nowrap" align="right">
                                          </td>
                                          <td width="61%">
                                            <table width="100%" cellpadding="5" cellspacing="1" border="0" class="colors_lines_light">
                                              <tbody><tr>
                                                <td class="colors_backgroundneutral">
                                                  <font style="font-weight: bold; line-height: 20px;">Saved Payment Methods:</font>
                                                  <br>
                                                  <select name="CCards" onchange="Choose_My_Saved_CCards(this.selectedIndex);savedCcDisabled(this.value, true)" style="background-color:#EEEEEE">
      <option></option>
      <option value="19282" class="v-saved-cc">Visa ************8108</option>
      <option value="19407" class="v-saved-cc"><font><font>PayPal</font></font></option>
      </select>
                                                </td>
                                              </tr>
                                            </tbody></table>
                                            <br>
                                          </td>
                                        </tr>
                                      </tbody></table>
                                    </td>
                                  </tr>
                                </tbody></table>
                                <table id="CC_paymentinfo" cellpadding="5">
                                  <tbody><tr>
                                    <!--<td colspan="2"><table width=100% cellpadding=1 cellspacing=0 border=1 align="center"><tr>-->
                                    <td width="150" nowrap="" align="right">
                                      <font class="fieldname_asterisk">*</font><font class="fieldname_required">Credit / Debit Card Type&nbsp;</font>
                                    </td>
                                    <td>
                                      <select name="CreditCardType" id="CreditCardType">
      <option value="5">Visa</option>
      <option value="6">MasterCard</option>
      <option value="7">American Express</option>
      <option value="8">Discover</option>
      </select>

                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="150" nowrap="" align="right">
                                      <font class="fieldname_asterisk">*</font><font class="fieldname_required">Credit / Debit Card Number&nbsp;</font>
                                    </td>
                                    <td>
                                      
                                      <input id="CreditCardNumber" name="CreditCardNumber" style="width: 200px;" maxlength="20" autocomplete="off">
                                      
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="150" nowrap="" align="right">
                                      <font class="fieldname_asterisk">*</font><font class="fieldname_required">Name on Card&nbsp;</font>
                                    </td>
                                    <td>
                                      <input id="CardHoldersName" name="CardHoldersName" value="" style="width: 200px;" maxlength="50">
                                    </td>
                                  </tr>
                                  
                                  <tr>
                                    <td width="150" nowrap="" align="right">
                                      <font class="fieldname_asterisk">*</font><font class="fieldname_required">Expiration Date&nbsp;</font>
                                    </td>
                                    <td>
                                      
                                      <div id="CC_ExpDate">
                                        <select name="CC_ExpDate_Month" id="CC_ExpDate_Month">
                                          <option value="">Choose Month</option><option value="01">01 - January</option><option value="02">02 - February</option><option value="03">03 - March</option><option value="04">04 - April</option><option value="05">05 - May</option><option value="06">06 - June</option><option value="07">07 - July</option><option value="08">08 - August</option><option value="09">09 - September</option><option value="10">10 - October</option><option value="11">11 - November</option><option value="12">12 - December</option>
                                        </select>
                                        /
                                        <select id="card_exp_year" name="CC_ExpDate_Year">
      <option value="">Choose Year</option>
      <option value="2016">2016</option>
      <option value="2017">2017</option>
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      <option value="2020">2020</option>
      <option value="2021">2021</option>
      <option value="2022">2022</option>
      <option value="2023">2023</option>
      <option value="2024">2024</option>
      <option value="2025">2025</option>
      <option value="2026">2026</option>
      <option value="2027">2027</option>
      <option value="2028">2028</option>
      <option value="2029">2029</option>
      <option value="2030">2030</option>
      <option value="2031">2031</option>
      </select>

                                      </div>
                                    </td>
                                  </tr>
                                  
                                </tbody></table>
                                
                                <table>
                                  <tbody><tr>
                                    <td width="150" nowrap="" align="right">
                                      <font class="fieldname_asterisk">*</font><font class="fieldname_required">Security Code&nbsp;</font>
                                      <br>
                                      <a href="pCCV2.asp" onclick="window.open('/Help_CCverify.asp', 'CVV2', 'resizable,width=440,height=375'); return false">
                                        Click here for help </a>
                                    </td>
                                    <td>
                                      <table cellpadding="0" cellspacing="0" border="0">
                                        <tbody><tr>
                                          <td>
                                            <input id="CVV2" name="CVV2" value="" style="width: 50px;" maxlength="4" autocomplete="off">
                                          </td>
                                          <td>
                                            &nbsp;
                                          </td>
                                          <td>
                                            <span class="txt_cvv2_sidenotes">
                                              <font size="1">(Required for Visa, MasterCard, AMEX &amp; Discover)</font></span>
                                          </td>
                                        </tr>
                                      </tbody></table>
                                    </td>
                                  </tr>
                                </tbody></table>
                                
                              </td>
                            </tr>
                          </tbody>
                          
                          <tbody id="ShowFields_ElectronicCheck" style="display: none;">
                            <tr>
                              <td width="150" align="right" nowrap="">
                                <font class="fieldname_asterisk">*</font><font class="fieldname_required">Bank Name&nbsp;</font>
                              </td>
                              <td>
                                <input name="BankName" value="" style="width: 200px;" maxlength="20">
                              </td>
                            </tr>
                            
                            <tr>
                              <td width="150" align="right" nowrap="">
                                <font class="fieldname_asterisk">*</font><font class="fieldname_required">Account Type&nbsp;</font>
                              </td>
                              <td>
                                <select name="AccountType">
                                  <option selected="">
                                    </option>
                                  <option value="CHECKING">
                                    CHECKING</option>
                                  <option value="SAVINGS">
                                    SAVINGS</option>
                                </select>
                              </td>
                            </tr>
                            
                            <tr>
                              <td width="150" align="right" nowrap="">
                                <font class="fieldname_asterisk">*</font><font class="fieldname_required">Routing Number&nbsp;</font>
                              </td>
                              <td>
                                <img src="/a/a/i//Account/Icon_eCheck_routingsymbol.gif" width="14" height="18">
                                <input name="RoutingNumber" value="" style="width: 200px;" maxlength="20" autocomplete="off">
                                <img src="/a/a/i//Account/Icon_eCheck_routingsymbol.gif" width="14" height="18" alt="">
                              </td>
                            </tr>
                            <tr>
                              <td width="150" align="right" nowrap="">
                                <font class="fieldname_asterisk">*</font><font class="fieldname_required">Account Number&nbsp;</font>
                              </td>
                              <td>
                                <input name="AccountNumber" value="" style="width: 200px;" maxlength="20" autocomplete="off">
                                <img src="/a/a/i//Account/Icon_eCheck_accountsymbol.gif" width="10" height="12" alt="">
                              </td>
                            </tr>
                            
                            <tr>
                              <td width="150" align="right" nowrap="">
                                <font class="fieldname_asterisk">*</font><font class="fieldname_required">Check Number&nbsp;</font>
                              </td>
                              <td>
                                <input name="CheckNumber" value="" style="width: 200px;" maxlength="5">
                              </td>
                            </tr>
                            
                          </tbody>
                          
                          <tbody id="ShowFields_PurchaseOrder" style="display: none;">
                            <tr>
                              <td width="150" align="right" nowrap="">
                                <font class="fieldname_asterisk">*</font><font class="fieldname_required">Purchase Order Number&nbsp;</font>
                              </td>
                              <td>
                                <input name="PONum" value="" style="width: 200px;" maxlength="20">
                              </td>
                            </tr>
                            
                          </tbody>
                          
                          <tbody id="ShowFields_Credits" style="display: none;">
                            <tr>
                              <td align="right">
                                <font class="fieldname_asterisk">*</font><font class="fieldname_required">Amount&nbsp;</font>
                              </td>
                              <td>
                                <input type="text" name="StoreCredit_Amount" style="width: 200px;">
                              </td>
                            </tr>
                            <tr>
                              <td align="right">
                                <font class="fieldname_asterisk">*</font><font class="fieldname_required">Send to Email&nbsp;</font>
                              </td>
                              <td>
                                <input type="text" name="StoreCredit_Email" style="width: 200px;" value="orbitaudio@gmail.com">
                              </td>
                            </tr>
                            <tr>
                              <td align="right">
                                <font class="fieldname_asterisk">*</font><font class="fieldname_required">Send to Name&nbsp;</font>
                              </td>
                              <td>
                                <input type="text" name="StoreCredit_ToName" style="width: 200px;" value="Joe&nbsp;Reineke">
                              </td>
                            </tr>
                            <tr>
                              <td align="right">
                                <font class="fieldname_required">Gift Message&nbsp;</font>
                              </td>
                              <td>
                                <input type="text" name="StoreCredit_Message" style="width: 200px;">&nbsp;(optional)
                              </td>
                            </tr>
                            <tr>
                              <td align="right">
                                <font class="fieldname_required">Send via Email Now&nbsp;</font>
                              </td>
                              <td>
                                <input type="checkbox" class="checkbox" name="StoreCredit_SendNow" value="Y" checked="checked">
                              </td>
                            </tr>
                            <tr>
                              <td align="right">
                                <font class="fieldname_required">For RMA&nbsp;</font>
                              </td>
                              <td>
                                <input type="checkbox" class="checkbox" name="StoreCredit_Exclude" value="Y">
                              </td>
                            </tr>
                          </tbody>
                          <tbody id="ShowFields_Manual" style="display: none;">
                            <tr>
                              <td align="right">
                                <font class="fieldname_asterisk">*</font><font class="fieldname_required">Payment Date&nbsp;</font>
                              </td>
                              <td>
                                <input type="text" name="Pay_AuthDate" style="width: 200px;" value="7/13/2016 6:09:50 PM">
                              </td>
                            </tr>
                            <tr>
                              <td align="right">
                                <font class="fieldname_asterisk">*</font><font class="fieldname_required">Payment Type&nbsp;</font>
                              </td>
                              <td>
                                <select name="Pay_Result">
                                  <option value="AUTHORIZE">AUTHORIZE</option>
                                  <option value="CAPTURE">CAPTURE</option>
                                  <option value="DEBIT">DEBIT / SALE (Authorize + Capture)</option>
                                  <option value="VOID">VOID</option>
                                  <option value="CREDIT">CREDIT - Adjustment</option>
                                  <option value="EXCLUDE_CREDIT">CREDIT - For RMAs</option>
                                  <option value="DECLINED">DECLINED</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td align="right">
                                <font class="fieldname_asterisk">*</font><font class="fieldname_required">Payment Amount&nbsp;</font>
                              </td>
                              <td>
                                <input type="text" name="Pay_Amount" style="width: 100px;">
                              </td>
                            </tr>
                            <tr>
                              <td align="right">
                                <font class="fieldname_asterisk">*</font><font class="fieldname_required">Paid Via&nbsp;</font>
                              </td>
                              <td>
                                <select class="editabletextinput_small" name="Pay_PaymentMethodID">
      <option value=""></option>
      <option value="25">CCAccepted</option><option value="1">NONE</option><option value="5"><font><font>Visa</font></font></option><option value="6"><font><font>MasterCard</font></font></option><option value="7"><font><font>American Express</font></font></option><option value="8"><font><font>Discover</font></font></option><option value="9">Diners Club</option><option value="12">JCB</option><option value="19">FirePay</option><option value="20">Delta</option><option value="21">SOLO</option><option value="22">Switch</option><option value="18"><font><font>PayPal</font></font></option><option value="3">Electronic Check</option><option value="2"><font><font>Check by Mail</font></font></option><option value="13">Purchase Order Number</option><option value="14"><font><font>Wire Transfer</font></font></option><option value="15">COD</option><option value="16"><font><font>Money Order</font></font></option><option value="17">Cash</option><option value="28"><font><font>Synchrony Account</font></font></option><option value="29"><font><font>QuickSpark Financing</font></font></option></select>

                              </td>
                            </tr>
                            <tr>
                              <td align="right">
                                <font class="fieldname_option">TransactionID&nbsp;</font>
                              </td>
                              <td>
                                <input type="text" name="Pay_TransID" style="width: 200px;"><font><font>&nbsp;(optional)
                              </font></font></td>
                            </tr>
                            <tr>
                              <td align="right">
                                <font class="fieldname_option">Reference Note&nbsp;</font>
                              </td>
                              <td>
                                <input type="text" name="Pay_Details" style="width: 200px;"><font><font>&nbsp;(optional)
                              </font></font></td>
                            </tr>
                          </tbody>
                          <tfoot id="ShowFooter_Default">
                            <tr>
                              <td width="150" nowrap="" align="right">
                                &nbsp;
                              </td>
                              <td>
                                <a href="javascript:void(0);" onclick="savedCcDisabled('','submit');" class="v13-button-primary" id="applyNewPaymentButton">
                                  <div>
                                    Apply Payment Method</div>
                                </a>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="2">
                                <input type="radio" class="radio" name="Apply_Payment_Method_To_All_Orders" value="" checked="checked">
                                Apply this payment method change to my Order#:
                                17727
                                <br>
                                <input type="radio" class="radio" name="Apply_Payment_Method_To_All_Orders" value="Y">
                                Apply this payment method change to ALL my existing orders.
                              </td>
                            </tr>
                          </tfoot>
                          <tfoot id="ShowFooter_Manual" style="display: none;">
                            <tr>
                              <td>
                                <a href="AdminDetails_ProcessOrder.asp?ShowManualPayment=Y&amp;table=orders&amp;Page=1&amp;ID=17727">
                                </a>
                              </td>
                              <td>
                                <div style="display: none;">
                                  <input type="submit" id="Add" name="Add" value="Add Offline Payment"></div>
                                <span class="a65chrome_btn_small save"><a href="javascript:void(0);" onclick="PerformImpersonatedClickEvent('Add');">
                                  <span>Apply Offline Payment</span></a> </span>
                              </td>
                            </tr>
                          </tfoot>
                          <tfoot id="ShowFooter_Credits" style="display: none;">
                            <tr>
                              <td>
                                <a href="AdminDetails_ProcessOrder.asp?ShowManualPayment=Y&amp;table=orders&amp;Page=1&amp;ID=17727">
                                </a>
                              </td>
                              <td>
                                <input type="hidden" name="StoreCredit_CustomerID" value="5114">
                                <div style="display: none;">
                                  <input type="submit" id="btnissue_store_credit" name="btnissue_store_credit" value="Apply Credit"></div>
                                <span class="a65chrome_btn_small save"><a href="javascript:void(0);" onclick="PerformImpersonatedClickEvent('btnissue_store_credit');">
                                  <span><font><font>Apply Credit</font></font></span></a> </span>
                              </td>
                            </tr>
                          </tfoot>
                        </table>
                        <script language="javascript" type="text/javascript"></script>

                    </div>
                  </div>
                </td>
              </tr>
            </tbody></table>
          </td>
          <td>
            <table width="100%" border="0">
              <tbody><tr>
                <td>
                  <span class="customer_title">Payment Log</span>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="contentareanoscrollstyle v13-grid">
                    
                    <table class="rounded-corner rounded-table table-standard">
                      <tbody><tr class="title underlined">
                        <td>
                            Payment Date</td>
                        
                        <td>
                          Payment Type
                        </td>
                        <td>
                          Payment Amount
                        </td>
                        <td colspan="2">
                          Paid Via
                        </td>
                      </tr>
                                    
                      <tr style="cursor: default;" id="pl0a" bgcolor="#FFFFFF" class="onesmall" onmouseover="this.bgColor='#bfbfbf';v$('pl0b').bgColor=this.bgColor;" onmouseout="this.bgColor='#FFFFFF';v$('pl0b').bgColor=this.bgColor;">
                        <td>
                          07/01/2016 05:51PM
                        </td>
                        <td>
                          DEBIT
                        </td>
                        <td>
                          $3,524.00
                        </td>
                        <td>
                          Visa&nbsp;
      ************8108

                        </td>
                        <td width="22">
                                              
                          <a title="Delete this transaction" onclick="javascript:return confirm('Are you sure you wish to delete this transaction?');" href="AdminDetails_ProcessOrder.asp?Delete_Pay=18612&amp;Page=1&amp;ID=17727">
                            <span class="v13-icon-close"></span></a>
                                              
                        </td>
                      </tr>
                      
                      <tr style="cursor: default;" id="pl0b" bgcolor="#FFFFFF">
                        <td colspan="5">
                          <div id="pl0_details" class="expandeddetails" style="display: block;">
                            <table border="0" width="100%">
                              <tbody><tr>
                                <td width="160">
                                  <div style="margin-bottom: 5px;">
                                    <strong>AuthCode</strong>
                                    
      </div>
                                  <div>
                                    <strong>TransID</strong>
                                    3BJ66239U0452600W</div>
                      
                                </td>
                                <td width="250">
                                                            
                                  <div style="margin-bottom: 5px;">
                                    <strong>AVS</strong>
                                    Y</div>
                                  <div>
                                                            
                                  <strong>CVV2</strong>
                                      M</div>
                                                             
                                </td>

                                <td colspan="2" align="right">
                      
                                </td>
                              </tr>
                            </tbody></table>
                        
                          </div>
                        </td>
                      </tr>
                      
                    </tbody></table>
                    
                  </div>
                </td>
              </tr>
            </tbody></table>
          </td>
        </tr>
      </tbody></table>
      </div></div>
  </form>
  <div id="floatsave" class="v13-savebar wrapper_fixed" style="visibility: hidden;">
    <div class="content_fixed">
      <div class="v13-savebar-buttoncontainer">
        <a onclick="saveOrder();" href="javascript:void(0);" class="v13-button-primary-large">Save</a>
      </div>
      <a title="Cancel" class="floating_cancel_link" href="<?php echo $act_list?>">Cancel</a>
    </div>
  </div>
</div>

<script type="text/javascript" src="view/javascript/jquery/ui/jquery-ui-timepicker-addon.js"></script> 
<script type="text/javascript"><!--
$('.date').datepicker({dateFormat: 'yy-mm-dd'});
$('.datetime').datetimepicker({
  dateFormat: 'yy-mm-dd',
  timeFormat: 'h:m'
});
$('.time').timepicker({timeFormat: 'h:m'});

var ShowSave = function() {
  $('#floatsave').css('visibility', 'visible');
}

var saveOrder = function() {
  if(!confirm("Are you sure?")) return;
  $('#order_form').submit();
}
//--></script>

<script type="text/javascript"><!--
$('input[name=\'product\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' + encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {	
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id,
						model: item.model,
						option: item.option,
						price: item.price
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('input[name=\'product\']').attr('value', ui.item['label']);
		$('input[name=\'product_id\']').attr('value', ui.item['value']);
		
		if (ui.item['option'] != '') {
			html = '';

			for (i = 0; i < ui.item['option'].length; i++) {
				option = ui.item['option'][i];
				
				if (option['type'] == 'select') {
					html += '<div id="option-' + option['product_option_id'] + '">';
					
					if (option['required']) {
						html += '<span class="required">*</span> ';
					}
				
					html += option['name'] + '<br />';
					html += '<select name="option[' + option['product_option_id'] + ']">';
					html += '<option value="">Select</option>';
				
					for (j = 0; j < option['option_value'].length; j++) {
						option_value = option['option_value'][j];
						
						html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];
						
						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}
						
						html += '</option>';
					}
						
					html += '</select>';
					html += '</div>';
					html += '<br />';
				}
				
				if (option['type'] == 'radio') {
					html += '<div id="option-' + option['product_option_id'] + '">';
					
					if (option['required']) {
						html += '<span class="required">*</span> ';
					}
				
					html += option['name'] + '<br />';
					html += '<select name="option[' + option['product_option_id'] + ']">';
					html += '<option value="">Select</option>';
				
					for (j = 0; j < option['option_value'].length; j++) {
						option_value = option['option_value'][j];
						
						html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];
						
						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}
						
						html += '</option>';
					}
						
					html += '</select>';
					html += '</div>';
					html += '<br />';
				}
					
				if (option['type'] == 'checkbox') {
					html += '<div id="option-' + option['product_option_id'] + '">';
					
					if (option['required']) {
						html += '<span class="required">*</span> ';
					}
					
					html += option['name'] + '<br />';
					
					for (j = 0; j < option['option_value'].length; j++) {
						option_value = option['option_value'][j];
						
						html += '<input type="checkbox" name="option[' + option['product_option_id'] + '][]" value="' + option_value['product_option_value_id'] + '" id="option-value-' + option_value['product_option_value_id'] + '" />';
						html += '<label for="option-value-' + option_value['product_option_value_id'] + '">' + option_value['name'];
						
						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}
						
						html += '</label>';
						html += '<br />';
					}
					
					html += '</div>';
					html += '<br />';
				}
			
				if (option['type'] == 'image') {
					html += '<div id="option-' + option['product_option_id'] + '">';
					
					if (option['required']) {
						html += '<span class="required">*</span> ';
					}
				
					html += option['name'] + '<br />';
					html += '<select name="option[' + option['product_option_id'] + ']">';
					html += '<option value="">Select</option>';
				
					for (j = 0; j < option['option_value'].length; j++) {
						option_value = option['option_value'][j];
						
						html += '<option value="' + option_value['product_option_value_id'] + '">' + option_value['name'];
						
						if (option_value['price']) {
							html += ' (' + option_value['price_prefix'] + option_value['price'] + ')';
						}
						
						html += '</option>';
					}
						
					html += '</select>';
					html += '</div>';
					html += '<br />';
				}
						
				if (option['type'] == 'text') {
					html += '<div id="option-' + option['product_option_id'] + '">';
					
					if (option['required']) {
						html += '<span class="required">*</span> ';
					}
					
					html += option['name'] + '<br />';
					html += '<input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['option_value'] + '" />';
					html += '</div>';
					html += '<br />';
				}
				
				if (option['type'] == 'textarea') {
					html += '<div id="option-' + option['product_option_id'] + '">';
					
					if (option['required']) {
						html += '<span class="required">*</span> ';
					}
					
					html += option['name'] + '<br />';
					html += '<textarea name="option[' + option['product_option_id'] + ']" cols="40" rows="5">' + option['option_value'] + '</textarea>';
					html += '</div>';
					html += '<br />';
				}
				
				if (option['type'] == 'file') {
					html += '<div id="option-' + option['product_option_id'] + '">';
					
					if (option['required']) {
						html += '<span class="required">*</span> ';
					}
					
					html += option['name'] + '<br />';
					html += '<a id="button-option-' + option['product_option_id'] + '" class="button">Upload</a>';
					html += '<input type="hidden" name="option[' + option['product_option_id'] + ']" value="' + option['option_value'] + '" />';
					html += '</div>';
					html += '<br />';
				}
				
				if (option['type'] == 'date') {
					html += '<div id="option-' + option['product_option_id'] + '">';
					
					if (option['required']) {
						html += '<span class="required">*</span> ';
					}
					
					html += option['name'] + '<br />';
					html += '<input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['option_value'] + '" class="date" />';
					html += '</div>';
					html += '<br />';
				}
				
				if (option['type'] == 'datetime') {
					html += '<div id="option-' + option['product_option_id'] + '">';
					
					if (option['required']) {
						html += '<span class="required">*</span> ';
					}
					
					html += option['name'] + '<br />';
					html += '<input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['option_value'] + '" class="datetime" />';
					html += '</div>';
					html += '<br />';						
				}
				
				if (option['type'] == 'time') {
					html += '<div id="option-' + option['product_option_id'] + '">';
					
					if (option['required']) {
						html += '<span class="required">*</span> ';
					}
					
					html += option['name'] + '<br />';
					html += '<input type="text" name="option[' + option['product_option_id'] + ']" value="' + option['option_value'] + '" class="time" />';
					html += '</div>';
					html += '<br />';						
				}
			}
			
			$('#option').html('<td class="left">Select</td><td class="left">' + html + '</td>');

			for (i = 0; i < ui.item.option.length; i++) {
				option = ui.item.option[i];
				
				if (option['type'] == 'file') {		
					new AjaxUpload('#button-option-' + option['product_option_id'], {
						action: 'index.php?route=sale/order/upload&token=<?php echo $token; ?>',
						name: 'file',
						autoSubmit: true,
						responseType: 'json',
						data: option,
						onSubmit: function(file, extension) {
							$('#button-option-' + (this._settings.data['product_option_id'] + '-' + this._settings.data['product_option_id'])).after('<img src="view/image/loading.gif" class="loading" />');
						},
						onComplete: function(file, json) {

							$('.error').remove();
							
							if (json['success']) {
								alert(json['success']);
								
								$('input[name=\'option[' + this._settings.data['product_option_id'] + ']\']').attr('value', json['file']);
							}
							
							if (json.error) {
								$('#option-' + this._settings.data['product_option_id']).after('<span class="error">' + json['error'] + '</span>');
							}
							
							$('.loading').remove();	
						}
					});
				}
			}
			
			$('.date').datepicker({dateFormat: 'yy-mm-dd'});
			$('.datetime').datetimepicker({
				dateFormat: 'yy-mm-dd',
				timeFormat: 'h:m'
			});
			$('.time').timepicker({timeFormat: 'h:m'});				
		} else {
			$('#option td').remove();
		}
		
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});	
//--></script>  
<?php echo $footer; ?>