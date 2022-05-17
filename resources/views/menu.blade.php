<div class="primary-nav">
        <button href="#" class="hamburger open-panel nav-toggle active">
            <span class="screen-reader-text">Menu</span>
        </button>

        <nav role="navigation" class="menu">
            <a href="#" class="logotype">LOGO<span>TYPE</span></a>
            <div class="overflow-container">
                <ul class="menu-dropdown">
                  
                    <li class="menu-hasdropdown">
                        <a href="#">Khám bệnh</a><span class="icon"><i class="fa fa-heart"></i></span>
                        <label title="toggle menu" for="setting">
                            <span class="downarrow"><i class="fa fa-caret-down"></i></span>
                        </label>
                        <input type="checkbox" class="sub-menu-checkbox" id="setting" />
                        <ul class="sub-menu-dropdown">
                            <li class="click-list"><a href="">Danh sách bệnh nhân</a></li>
                            <li class="click-list"><a href="">Khám bệnh</a></li>
                            <li class="click-list"><a href="">Lịch sử khám bệnh</a></li>
                        </ul>
                    </li>
                    <li class="menu-hasdropdown">
                        <a href="#">Hệ thống</a><span class="icon"><i class="fa fa-gear"></i></span>
                        <label title="toggle menu" for="settings">
                            <span class="downarrow"><i class="fa fa-caret-down"></i></span>
                        </label>
                        <input type="checkbox" class="sub-menu-checkbox" id="settings" />
                        <ul class="sub-menu-dropdown">
                            <li><a href="">Danh sách bác sĩ</a></li>
                            <li><a href="{{route('getMedicines')}}">Danh sách thuốc</a></li>
                            <li><a href="{{route('getLibrary')}}">Danh sách library</a></li>
                            <li><a href="{{route('getService')}}">Danh sách dịch vụ</a></li>
                            <li><a href="">Danh sách user</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
</div>