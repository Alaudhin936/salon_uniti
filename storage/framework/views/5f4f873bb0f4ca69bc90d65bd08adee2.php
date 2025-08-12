<div class="sidebar-wrapper">
    <div>
      <div class="logo-wrapper"><a href="<?php echo e(route('vendor_dashboard')); ?>"><h3>Salon Unitii</h3></a>
        <a class="logo-wrapper">Vendor Page</a>
        <div class="back-btn"><i data-feather="grid"></i></div>
        <div class="toggle-sidebar icon-box-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
      </div>
      <div class="logo-icon-wrapper"><a href="<?php echo e(route('dashboard')); ?>">
          <div class="icon-box-sidebar"><i data-feather="grid"></i></div></a></div>
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn">
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            <li class="pin-title sidebar-list">
              <h6>Pinned</h6>
            </li>
            <hr>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="home"></i><span class="lan-3">Salon</span></a>
              <ul class="sidebar-submenu">
                <li><a class="lan-4" href="<?php echo e(route('dashboard')); ?>">Default</a></li>
                <li><a class="lan-5" href="<?php echo e(route('ecommerce_dashboard')); ?>">Ecommerce</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="airplay"></i><span class="lan-6">Widgets</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('general_widget')); ?>">General</a></li>
                <li><a href="<?php echo e(route('chart_widget')); ?>">Chart</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="layout"></i><span class="lan-7">Page layout</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('box_layout')); ?>">Boxed</a></li>
                <li><a href="<?php echo e(route('layout_rtl')); ?>">RTL</a></li>
                <li><a href="<?php echo e(route('layout_dark')); ?>">Dark Layout</a></li>
                <li><a href="<?php echo e(route('hide_on_scroll')); ?>">Hide Nav Scroll</a></li>
                <li><a href="<?php echo e(route('footer_light')); ?>">Footer Light</a></li>
                <li><a href="<?php echo e(route('footer_dark')); ?>">Footer Dark</a></li>
                <li><a href="<?php echo e(route('footer_fixed')); ?>">Footer Fixed</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="box"></i><span>Project</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('projects')); ?>">Project List</a></li>
                <li><a href="<?php echo e(route('project_create')); ?>">Create new</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('file_manager')); ?>"><i data-feather="git-pull-request"> </i><span>File manager</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('kanban')); ?>"><i data-feather="monitor"> </i><span>kanban Board</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="shopping-bag"></i><span>Ecommerce</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('product')); ?>">Product</a></li>
                <li><a href="<?php echo e(route('product_page')); ?>">Product page</a></li>
                <li><a href="<?php echo e(route('add_products')); ?>">Add Product</a></li>
                <li><a href="<?php echo e(route('list_products')); ?>">Product list</a></li>
                <li><a href="<?php echo e(route('payment_details')); ?>">Payment Details</a></li>
                <li><a href="<?php echo e(route('order_history')); ?>">Order History</a></li>
                <li><a href="<?php echo e(route('invoice_template')); ?>">Invoice</a></li>
                <li><a href="<?php echo e(route('cart')); ?>">Cart</a></li>
                <li><a href="<?php echo e(route('list_wish')); ?>">Wishlist</a></li>
                <li><a href="<?php echo e(route('checkout')); ?>">Checkout</a></li>
                <li><a href="<?php echo e(route('pricing')); ?>">Pricing</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="mail"></i><span>Email</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('email_inbox')); ?>">Mail Inbox</a></li>
                <li><a href="<?php echo e(route('email_read')); ?>">Read mail</a></li>
                <li><a href="<?php echo e(route('email_compose')); ?>">Compose</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="message-circle"></i><span>Chat</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('chat')); ?>">Chat App</a></li>
                <li><a href="<?php echo e(route('chat_video')); ?>">Video chat</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="users"></i><span>Users</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('user_profile')); ?>">Users Profile</a></li>
                <li><a href="<?php echo e(route('edit_profile')); ?>">Users Edit</a></li>
                <li><a href="<?php echo e(route('user_cards')); ?>">Users Cards</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('bookmark')); ?>"><i data-feather="heart"> </i><span>Bookmarks</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('contacts')); ?>"><i data-feather="list"> </i><span>Contacts</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('task')); ?>"><i data-feather="check-square"> </i><span>Tasks</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('calendar_basic')); ?>"><i data-feather="calendar"> </i><span>Calendar</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('social_app')); ?>"><i data-feather="zap"> </i><span>Social App</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('to_do')); ?>"><i data-feather="clock"> </i><span>To-Do</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('search')); ?>"><i data-feather="search"> </i><span>Search Result</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="file-text"></i><span>Forms</span></a>
              <ul class="sidebar-submenu">
                <li><a class="submenu-title" href="javascript:void(0)">Form Controls<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="<?php echo e(route('form_validation')); ?>">Form Validation</a></li>
                    <li><a href="<?php echo e(route('base_input')); ?>">Base Inputs</a></li>
                    <li><a href="<?php echo e(route('radio_checkbox_control')); ?>">Checkbox & Radio</a></li>
                    <li><a href="<?php echo e(route('input_group')); ?>">Input Groups</a></li>
                    <li><a href="<?php echo e(route('megaoptions')); ?>">Mega Options</a></li>
                  </ul>
                </li>
                <li><a class="submenu-title" href="javascript:void(0)">Form Widgets<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="<?php echo e(route('datepicker')); ?>">Datepicker</a></li>
                    <li><a href="<?php echo e(route('time_picker')); ?>">Timepicker</a></li>
                    <li><a href="<?php echo e(route('datetimepicker')); ?>">Datetimepicker</a></li>
                    <li><a href="<?php echo e(route('daterangepicker')); ?>">Daterangepicker</a></li>
                    <li><a href="<?php echo e(route('touchspin')); ?>">Touchspin</a></li>
                    <li><a href="<?php echo e(route('select2')); ?>">Select2</a></li>
                    <li><a href="<?php echo e(route('switch')); ?>">Switch</a></li>
                    <li><a href="<?php echo e(route('typeahead')); ?>">Typeahead</a></li>
                    <li><a href="<?php echo e(route('clipboard')); ?>">Clipboard</a></li>
                  </ul>
                </li>
                <li><a class="submenu-title" href="javascript:void(0)">Form layout<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="<?php echo e(route('default_form')); ?>">Default Forms</a></li>
                    <li><a href="<?php echo e(route('form_wizard')); ?>">Form Wizard 1</a></li>
                    <li><a href="<?php echo e(route('form_wizard_two')); ?>">Form Wizard 2</a></li>
                    <li><a href="<?php echo e(route('form_wizard_three')); ?>">Form Wizard 3</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="server"></i><span>Tables</span></a>
              <ul class="sidebar-submenu">
                <li><a class="submenu-title" href="javascript:void(0)">Bootstrap Tables<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="<?php echo e(route('bootstrap_basic_table')); ?>">Basic Tables</a></li>
                    <li><a href="<?php echo e(route('table_components')); ?>">Table components</a></li>
                  </ul>
                </li>
                <li><a class="submenu-title" href="javascript:void(0)">Data Tables<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="<?php echo e(route('datatable_basic_init')); ?>">Basic Table</a></li>
                    <li><a href="<?php echo e(route('datatable_advance')); ?>">Advance Init</a></li>
                    <li><a href="<?php echo e(route('datatable_api')); ?>">Data API </a></li>
                    <li><a href="<?php echo e(route('datatable_data_source')); ?>">Data Source</a></li>
                  </ul>
                </li>
                <li><a href="<?php echo e(route('datatable_ext_autofill')); ?>">Ex. Data Table     </a></li>
                <li><a href="<?php echo e(route('jsgrid_table')); ?>">Js Grid Table        </a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="box"></i><span>Ui Kits</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('typography')); ?>">Typography</a></li>
                <li><a href="<?php echo e(route('avatars')); ?>">Avatars</a></li>
                <li><a href="<?php echo e(route('helper_classes')); ?>">helper classes</a></li>
                <li><a href="<?php echo e(route('grid')); ?>">Grid</a></li>
                <li><a href="<?php echo e(route('tag_pills')); ?>">Tag & pills</a></li>
                <li><a href="<?php echo e(route('progress_bar')); ?>">Progress</a></li>
                <li><a href="<?php echo e(route('modal')); ?>">Modal</a></li>
                <li><a href="<?php echo e(route('alert')); ?>">Alert</a></li>
                <li><a href="<?php echo e(route('popover')); ?>">Popover</a></li>
                <li><a href="<?php echo e(route('tooltip')); ?>">Tooltip</a></li>
                <li><a href="<?php echo e(route('loader')); ?>">Spinners</a></li>
                <li><a href="<?php echo e(route('dropdown')); ?>">Dropdown</a></li>
                <li><a href="<?php echo e(route('according')); ?>">Accordion</a></li>
                <li><a class="submenu-title" href="javascript:void(0)">Tabs<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="<?php echo e(route('tab_bootstrap')); ?>">Bootstrap Tabs</a></li>
                    <li><a href="<?php echo e(route('tab_material')); ?>">Line Tabs</a></li>
                  </ul>
                </li>
                <li><a href="<?php echo e(route('box_shadow')); ?>">Shadow</a></li>
                <li><a href="<?php echo e(route('list')); ?>">Lists</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="folder-plus"></i><span>Bonus Ui</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('scrollable')); ?>">Scrollable</a></li>
                <li><a href="<?php echo e(route('tree')); ?>">Tree view</a></li>
                <li><a href="<?php echo e(route('bootstrap_notify')); ?>">Bootstrap Notify</a></li>
                <li><a href="<?php echo e(route('rating')); ?>">Rating</a></li>
                <li><a href="<?php echo e(route('dropzone')); ?>">dropzone</a></li>
                <li><a href="<?php echo e(route('tour')); ?>">Tour</a></li>
                <li><a href="<?php echo e(route('sweet_alert2')); ?>">SweetAlert2</a></li>
                <li><a href="<?php echo e(route('modal_animated')); ?>">Animated Modal</a></li>
                <li><a href="<?php echo e(route('owl_carousel')); ?>">Owl Carousel</a></li>
                <li><a href="<?php echo e(route('ribbons')); ?>">Ribbons</a></li>
                <li><a href="<?php echo e(route('pagination')); ?>">Pagination</a></li>
                <li><a href="<?php echo e(route('breadcrumb')); ?>">Breadcrumb</a></li>
                <li><a href="<?php echo e(route('range_slider')); ?>">Range Slider</a></li>
                <li><a href="<?php echo e(route('image_cropper')); ?>">Image cropper</a></li>
                <li><a href="<?php echo e(route('sticky')); ?>">Sticky</a></li>
                <li><a href="<?php echo e(route('basic_card')); ?>">Basic Card</a></li>
                <li><a href="<?php echo e(route('dragable_card')); ?>">Draggable Card</a></li>
                <li><a class="submenu-title" href="javascript:void(0)">Timeline<span class="sub-arrow"><i class="fa fa-angle-right"></i></span></a>
                  <ul class="nav-sub-childmenu submenu-content">
                    <li><a href="<?php echo e(route('timeline_v_1')); ?>">Timeline 1</a></li>
                    <li><a href="<?php echo e(route('timeline_v_2')); ?>">Timeline 2</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="cloud-drizzle"></i><span>Animation</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('animate')); ?>">Animate</a></li>
                <li><a href="<?php echo e(route('scroll_reval')); ?>">Scroll Reveal</a></li>
                <li><a href="<?php echo e(route('aos')); ?>">AOS animation</a></li>
                <li><a href="<?php echo e(route('tilt')); ?>">Tilt Animation</a></li>
                <li><a href="<?php echo e(route('wow')); ?>">Wow Animation</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="command"></i><span>Icons</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('flag_icon')); ?>">Flag icon</a></li>
                <li><a href="<?php echo e(route('font_awesome')); ?>">Fontawesome Icon</a></li>
                <li><a href="<?php echo e(route('ico_icon')); ?>">Ico Icon</a></li>
                <li><a href="<?php echo e(route('themify_icon')); ?>">Themify Icon</a></li>
                <li><a href="<?php echo e(route('feather_icon')); ?>">Feather icon</a></li>
                <li><a href="<?php echo e(route('whether_icon')); ?>">Whether Icon</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="cloud"></i><span>Buttons</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('buttons')); ?>">Default Style</a></li>
                <li><a href="<?php echo e(route('button_group')); ?>">Button Group</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="bar-chart"></i><span>Charts</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('chart_apex')); ?>">Apex Chart</a></li>
                <li><a href="<?php echo e(route('chart_sparkline')); ?>">Sparkline chart</a></li>
                <li><a href="<?php echo e(route('chart_flot')); ?>">Flot Chart</a></li>
                <li><a href="<?php echo e(route('chart_knob')); ?>">Knob Chart</a></li>
                <li><a href="<?php echo e(route('chart_morris')); ?>">Morris Chart</a></li>
                <li><a href="<?php echo e(route('chartjs')); ?>">Chatjs Chart</a></li>
                <li><a href="<?php echo e(route('chartist')); ?>">Chartist Chart</a></li>
                <li><a href="<?php echo e(route('chart_peity')); ?>">Peity Chart</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('sample_page')); ?>"><i data-feather="file-text"> </i><span>Sample page</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('internationalization')); ?>"><i data-feather="globe"> </i><span>Internationalize</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('dashboard')); ?>" target="_blank"><i data-feather="anchor"></i><span>Starter kit</span></a></li>
            <li class="mega-menu sidebar-list"> <i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="layers"></i><span>Others</span></a>
              <div class="mega-menu-container menu-content">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col mega-box">
                      <div class="link-section">
                        <div class="submenu-title">
                          <h5>Error Page</h5>
                        </div>
                        <ul class="submenu-content opensubmegamenu">
                          <li><a href="<?php echo e(route('error_page1')); ?>">Error Page 1</a></li>
                          <li><a href="<?php echo e(route('error_page2')); ?>">Error Page 2</a></li>
                          <li><a href="<?php echo e(route('error_page3')); ?>">Error Page 3</a></li>
                          <li><a href="<?php echo e(route('error_page4')); ?>">Error Page 4</a></li>
                          <li><a href="<?php echo e(route('error_page5')); ?>">Error Page 5 </a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col mega-box">
                      <div class="link-section">
                        <div class="submenu-title">
                          <h5> Authentication</h5>
                        </div>
                        <ul class="submenu-content opensubmegamenu">
                          <li><a href="<?php echo e(route('login')); ?>" target="_blank">Login Simple</a></li>
                          <li><a href="<?php echo e(route('login_one')); ?>" target="_blank">Login with bg image</a></li>
                          <li><a href="<?php echo e(route('login_two')); ?>" target="_blank">Login with image two                      </a></li>
                          <li><a href="<?php echo e(route('login_bs_validation')); ?>" target="_blank">Login With validation</a></li>
                          <li><a href="<?php echo e(route('login_bs_tt_validation')); ?>" target="_blank">Login with tooltip</a></li>
                          <li><a href="<?php echo e(route('login_sa_validation')); ?>" target="_blank">Login with sweetalert</a></li>
                          <li><a href="<?php echo e(route('sign_up')); ?>" target="_blank">Register Simple</a></li>
                          <li><a href="<?php echo e(route('sign_up_one')); ?>" target="_blank">Register with Bg Image</a></li>
                          <li><a href="<?php echo e(route('sign_up_two')); ?>" target="_blank">Register with Image Two</a></li>
                          <li><a href="<?php echo e(route('unlock')); ?>">Unlock User</a></li>
                          <li><a href="<?php echo e(route('forget_password')); ?>">Forget Password</a></li>
                          <li><a href="<?php echo e(route('reset_password')); ?>">Reset Password</a></li>
                          <li><a href="<?php echo e(route('maintenance')); ?>">Maintenance</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col mega-box">
                      <div class="link-section">
                        <div class="submenu-title">
                          <h5>Coming Soon</h5>
                        </div>
                        <ul class="submenu-content opensubmegamenu">
                          <li><a href="<?php echo e(route('comingsoon')); ?>">Coming Simple</a></li>
                          <li><a href="<?php echo e(route('comingsoon_bg_video')); ?>">Coming with Bg video</a></li>
                          <li><a href="<?php echo e(route('comingsoon_bg_img')); ?>">Coming with Bg Image</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col mega-box">
                      <div class="link-section">
                        <div class="submenu-title">
                          <h5>Email templates</h5>
                        </div>
                        <ul class="submenu-content opensubmegamenu">
                          <li><a href="<?php echo e(route('basic_template')); ?>">Basic Email</a></li>
                          <li><a href="<?php echo e(route('email_header')); ?>">Basic With Header</a></li>
                          <li><a href="<?php echo e(route('template_email')); ?>">Ecommerce Template</a></li>
                          <li><a href="<?php echo e(route('template_email_2')); ?>">Email Template 2</a></li>
                          <li><a href="<?php echo e(route('ecommerce_templates')); ?>">Ecommerce Email</a></li>
                          <li><a href="<?php echo e(route('email_order_success')); ?>">Order Success</a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="image"></i><span>Gallery</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('gallery')); ?>">Gallery Grid</a></li>
                <li><a href="<?php echo e(route('gallery_with_description')); ?>">Gallery Grid Desc</a></li>
                <li><a href="<?php echo e(route('gallery_masonry')); ?>">Masonry Gallery</a></li>
                <li><a href="<?php echo e(route('masonry_gallery_with_disc')); ?>">Masonry with Desc</a></li>
                <li><a href="<?php echo e(route('gallery_hover')); ?>">Hover Effects</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="film"></i><span>Blog</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('blog')); ?>">Blog Details</a></li>
                <li><a href="<?php echo e(route('blog_single')); ?>">Blog Single</a></li>
                <li><a href="<?php echo e(route('add_post')); ?>">Add Post</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('faq')); ?>"><i data-feather="help-circle"> </i><span>FAQ</span></a></li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="package"></i><span>Job Search</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('job_cards_view')); ?>">Cards view</a></li>
                <li><a href="<?php echo e(route('job_list_view')); ?>">List View</a></li>
                <li><a href="<?php echo e(route('job_details')); ?>">Job Details</a></li>
                <li><a href="<?php echo e(route('job_apply')); ?>">Apply</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="radio"></i><span>Learning</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('learning_list_view')); ?>">Learning List</a></li>
                <li><a href="<?php echo e(route('learning_detailed')); ?>">Detailed Course</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="map"></i><span>Maps</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('map_js')); ?>">Maps JS</a></li>
                <li><a href="<?php echo e(route('vector_map')); ?>">Vector Maps</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="edit"></i><span>Editors</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('summernote')); ?>">Summer Note</a></li>
                <li><a href="<?php echo e(route('ckeditor')); ?>">CK editor</a></li>
                <li><a href="<?php echo e(route('simple_mde')); ?>">MDE editor</a></li>
                <li><a href="<?php echo e(route('ace_code_editor')); ?>">ACE code editor</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="sunrise"> </i><span>Knowledgebase</span></a>
              <ul class="sidebar-submenu">
                <li><a href="<?php echo e(route('knowledgebase')); ?>">Knowledgebase</a></li>
                <li><a href="<?php echo e(route('knowledge_category')); ?>">Knowledge category</a></li>
                <li><a href="<?php echo e(route('knowledge_detail')); ?>">Knowledge detail              </a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav" href="<?php echo e(route('support_ticket')); ?>"><i data-feather="users"> </i><span>Support Ticket</span></a></li>
          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
  </div>
<?php /**PATH C:\xampp8.2\htdocs\salon_unitiii\resources\views/layout/sidebar.blade.php ENDPATH**/ ?>