<?php $user = Auth::user(); ?>

<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Si-KAS</a>
          </div>

          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">S-K</a>
          </div>

          <ul class="sidebar-menu">
              <li class="menu-header">Menu</li>
              @foreach (App\Models\Menu::get() as $menuItem)
                @if ($menuItem->id_parent == null)
                  @if ($menuItem->url != null)
                    @can($menuItem->hak_akses->name)
                      <li class="nav-item">
                        <a href="{{ '/' . $menuItem->url }}" class="nav-link">
                          <p>
                            {{ $menuItem->judul }}
                          </p>
                        </a>
                      </li>
                    @endcan 
                    @else
                    @can($menuItem->hak_akses->name)
                      @if (strpos($menuItem->judul, 'Data') !== false)
                      <li class="nav-item">
                        <a href="#" class="nav-link">
                          <p>
                            {{ $menuItem->judul }}
                          </p>
                          <i class="fas fa-angle-left right"></i>
                        </a>
                        <ul class="nav nav-treeview">
                          @foreach ($menuItem->children as $subMenuItem)
                          @if ($subMenuItem->url == 'jenis')
                            <li class="{{ Request::is($subMenuItem->url) ? 'active' : null }}">
                              <a href="{{ '/' . $subMenuItem->url }}" class="nav-link"> 
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                  {{ $subMenuItem->judul }}
                                </p>
                              </a>
                            </li>
                          @endif
                        @endforeach
                        </ul>
                      </li>
                    @elseif (strpos($menuItem->judul, 'Account') !== false)
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <p>
                          {{ $menuItem->judul }}
                        </p>
                        <i class="fas fa-angle-left right"></i>
                      </a>
                      <ul class="nav nav-treeview">
                        @foreach ($menuItem->children as $subMenuAccount)
                            @if ($subMenuAccount->url == 'user')
                              <li class="{{ Request::is($subMenuAccount->url) ? 'active' : null }}">
                                <a href="{{ '/' . $subMenuAccount->url }}" class="nav-link"> 
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>
                                    {{ $subMenuAccount->judul }}
                                  </p>
                                </a>
                              </li>
                            @else
                              <li class="{{ Request::is($subMenuAccount->url) ? 'active' : null }}">
                                <a href="{{ '/' . $subMenuAccount->url }}" class="nav-link"> 
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>
                                    {{ $subMenuAccount->judul }}
                                  </p>
                                </a>
                              </li>
                            @endif
                          @endforeach
                       </ul>
                      </li>
                      @endif
                    @endcan
                  @endif
                @endif
              @endforeach
            </ul>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
              </a>
            </div>
        </aside>
      </div>