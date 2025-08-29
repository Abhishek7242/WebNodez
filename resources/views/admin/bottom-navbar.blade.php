          
           @php
        $dockItems = [
                  ['url' => '/admin/dashboard', 'icon' => 'fas fa-tachometer-alt', 'color' => 'text-green-400', 'label' => 'Dashboard'],
            ['url' => '/admin/user-ai-chats', 'icon' => 'fas fa-comments', 'color' => 'text-pink-400', 'label' => 'AI Chats'],
            ['url' => '/admin/tasks/dashboard', 'icon' => 'fas fa-tasks', 'color' => 'text-yellow-400', 'label' => 'Tasks'],
            ['url' => '/admin/manage-admins', 'icon' => 'fas fa-user-shield', 'color' => 'text-blue-400', 'label' => 'Admins'],

            ['url' => '/admin/manage-home', 'icon' => 'fas fa-home', 'color' => 'text-blue-400', 'label' => 'Home'],
            // extracted from your cards
            ['url' => '/admin/contact-details', 'icon' => 'fas fa-envelope', 'color' => 'text-pink-400', 'label' => 'Contacts'],
            ['url' => '/admin/manage-blogs', 'icon' => 'fas fa-blog', 'color' => 'text-green-400', 'label' => 'Blogs'],
            ['url' => '/admin/manage-services', 'icon' => 'fas fa-cogs', 'color' => 'text-purple-400', 'label' => 'Services'],
            ['url' => '/admin/manage-about', 'icon' => 'fas fa-info-circle', 'color' => 'text-yellow-400', 'label' => 'About'],
            ['url' => '/admin/manage-portfolio', 'icon' => 'fas fa-briefcase', 'color' => 'text-red-400', 'label' => 'Portfolio'],
            ['url' => '/admin/manage-terms', 'icon' => 'fas fa-file-contract', 'color' => 'text-indigo-400', 'label' => 'Terms'],
            ['url' => '/admin/manage-privacy', 'icon' => 'fas fa-shield-alt', 'color' => 'text-teal-400', 'label' => 'Privacy'],
            ['url' => '/admin/manage-og-images', 'icon' => 'fas fa-images', 'color' => 'text-orange-400', 'label' => 'OG Images'],
            ['url' => '/admin/manage-client-progress', 'icon' => 'fas fa-chart-line', 'color' => 'text-orange-400', 'label' => 'Progress'],
            ['url' => '/admin/manage-feedback', 'icon' => 'fas fa-star', 'color' => 'text-yellow-400', 'label' => 'Feedback'],
            ['url' => '/admin/send-email', 'icon' => 'fas fa-envelope-open-text', 'color' => 'text-pink-400', 'label' => 'Email'],
        ];
    @endphp
    
<style>
    /* --------------------
   CUSTOM DOCK CSS
-------------------- */

/* Toggle button */
.dock-btn {
    transition: transform 0.3s ease, background 0.3s ease;
}
.dock-btn:hover {
    transform: scale(1.1);
    background: #1f2937; /* gray-800 */
}

/* Profile button */
.profile-btn {
    background: linear-gradient(to right, #34d399, #059669); /* green gradient */
    transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
}
.profile-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    background: linear-gradient(to right, #10b981, #047857);
}

/* Profile wrapper (hidden by default, shows when dock is toggled) */
.dock-profile {
    opacity: 0;
    transform: translateX(40px);
    transition: all 0.5s ease;
}
#profile-button.show .dock-profile{
    opacity: 1;
    transform: translateX(0);
}

/* Profile dropdown card */
.profile-card {
    transition: opacity 0.3s ease;
}

/* Dock wrapper */
.dock-wrapper {
    background: transparent;
    backdrop-filter: none;
    pointer-events: none;
    transition: all 0.5s ease;
}
.dock-wrapper.show {
    background: rgba(0, 0, 0, 0.676);
    backdrop-filter: blur(12px);
    pointer-events: auto;
}
.dock-wrapper.show .dock-icon {
    opacity: 1;
    transform: translateX(0);
}

/* Dock icons */
.dock-icon {
    opacity: 0;
    transform: translateX(40px);
    transition: all 0.5s ease;
}
.dock-icon i {
    transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
}
.dock-wrapper.show .dock-icon i {
    background-color: rgba(255, 255, 255, 0.08);
}
.dock-wrapper.show .dock-icon i:hover {
    background-color: rgba(255, 255, 255, 0.15);
    box-shadow: 0 4px 12px rgba(255,255,255,0.3);
    transform: scale(1.25);
}

/* Labels above icons */
.dock-label {
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
}
.dock-icon:hover .dock-label {
    opacity: 1;
}

/* Profile button fixed placement */
#profile-button {
    z-index: 100;
    right: 60px;
    bottom: 100px;
    position: fixed;
}

     #profile-button {
    position: fixed;
    right: 60px;
    bottom: 100px;
    z-index: 100;

    width: 3rem;   /* w-12 */
    height: 3rem;  /* h-12 */
    border-radius: 9999px; /* rounded-full */
    background: linear-gradient(to right, #34d399, #059669); /* from-green-400 to-green-600 */
    color: white;
    font-weight: bold;
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    justify-content: center;

    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    cursor: pointer;
}

#profile-button:hover {
    /* transform: scale(1.1); */
    box-shadow: 0 6px 12px rgba(0,0,0,0.2);
    background: linear-gradient(to right, #10b981, #047857); /* hover darker green */
}

/* Optional: glowing subtle ring */
#profile-button::after {
    content: "";
    position: absolute;
    inset: 0;
    border-radius: 9999px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    pointer-events: none;
}

      #profile-button.show{
         opacity: 1;
        }
        .profile{
            bottom: 40px;
            
        }
    /* Dock animation */
    #dockIcons.show .dock-icon {
        opacity: 1;
        transform: translateX(0);
    }

    #dockToggle{
        position: fixed;
        right: 10px;
        bottom: 10px;
    }

    /* Hide dock background by default */
    #dockIcons {
        bottom: 15px;
        background: transparent;
        backdrop-filter: none;
       overflow-x: scroll; max-width: 80%;
    }
    #dockIcons {
  scrollbar-width: none;        /* Firefox */
  -ms-overflow-style: none;     /* IE/Edge */
}
#dockIcons::-webkit-scrollbar {
  display: none;                /* Chrome, Safari, Edge */
}

    /* Show background only when dock is expanded */
    #dockIcons.show { background: rgba(0, 0, 0, 0.676); backdrop-filter: blur(12px);  }
    @media screen and (max-width: 840px) {
  #dockIcons {
   max-width: 70%;
  }
}
    @media screen and (max-width: 540px) {
  #dockIcons {
  left: 0;
  }
}
  /* ---------- Scrollbar for #dockIcons.show (WebKit + Firefox) ---------- */
#dockIcons.show {
  /* Firefox: thin scrollbar and thumb/track colors (thumb, track) */
  scrollbar-width: thin;
  scrollbar-color: #5b8cff rgba(255,255,255,0.03);
}

/* WebKit browsers (Chrome, Edge, Safari) */
#dockIcons.show::-webkit-scrollbar {
  width: 10px;   /* vertical scrollbar width */
  height: 10px;  /* horizontal scrollbar height */
}

#dockIcons.show::-webkit-scrollbar-track {
  background: rgba(255,255,255,0.03);
  border-radius: 999px;
}

#dockIcons.show::-webkit-scrollbar-thumb {
  background: linear-gradient(90deg, #5b8cff, #7ae4c9);
  border-radius: 999px;
  box-shadow:
    inset 0 1px 0 rgba(255,255,255,0.25),   /* subtle inner highlight */
    0 3px 8px rgba(11,17,32,0.45);           /* soft outer shadow */
  border: 2px solid rgba(11,17,32,0.12);
  min-height: 24px;
  transition: box-shadow .18s ease, filter .12s ease;
}

#dockIcons.show::-webkit-scrollbar-thumb:hover {
  filter: brightness(1.06);
  box-shadow:
    inset 0 1px 0 rgba(255,255,255,0.28),
    0 6px 18px rgba(11,17,32,0.55);
}

#dockIcons.show::-webkit-scrollbar-thumb:active {
  filter: brightness(0.98);
  box-shadow:
    inset 0 1px 0 rgba(255,255,255,0.20),
    0 8px 26px rgba(11,17,32,0.60);
}

#dockIcons.show::-webkit-scrollbar-corner {
  background: transparent;
}

/* Respect reduced motion preference */
@media (prefers-reduced-motion: reduce) {
  #dockIcons.show::-webkit-scrollbar-thumb {
    transition: none;
  }
}


    /* Hide icon background when collapsed */
    #dockIcons .dock-icon i {
        background-color: transparent;
        transition: all 0.3s ease;
    }

    /* Apply background only on hover or when dock is expanded */
    #dockIcons.show .dock-icon i {
        background-color: rgba(255, 255, 255, 0.08);
    }

    #dockIcons.show .dock-icon i:hover {
        background-color: rgba(255, 255, 255, 0.15);
        box-shadow: 0 4px 12px rgba(255,255,255,0.3);
        transform: scale(1.25);
    }

    /* Labels above icons */
    .dock-icon span {
        pointer-events: none;
    }
    /* Dock Icon Label */
.icon-label {
    position: absolute;
    top: -2rem; /* -top-8 */
    background: rgba(0, 0, 0, 0.8);
    color: #fff;
    font-size: 0.75rem; /* text-xs */
    font-weight: 600;
    padding: 0.25rem 0.5rem; /* px-2 py-1 */
    border-radius: 0.5rem; /* rounded-lg */
    white-space: nowrap;

    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.dock-icon:hover .icon-label {
    opacity: 1;
}

</style>

<!-- Collapsible Mac Dock -->
<div id="dockContainer" class=" w-full justify-center right-6 z-50 flex items-center space-x-4">

    <!-- Main toggle button -->
    <div id="dockToggle" class="flex items-center justify-center w-14 h-14 bg-gray-900 text-white rounded-full shadow-lg cursor-pointer hover:bg-gray-800 transition-transform duration-300 transform hover:scale-110">
        <i class="fas fa-th text-xl"></i>
    </div>
    
<div id="profile-button" class="dock-icon fixed  right-6 bottom-6 group flex flex-col items-center opacity-0 translate-x-10 transition-all duration-500">
            
                  <button
    class="dock-profile dock-icon w-12 h-12 rounded-full bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center text-white font-bold shadow-md hover:shadow-lg hover:scale-110 transform transition-all duration-300">
    {{ substr(auth()->guard('admin')->user()->name ?? 'A', 0, 1) }}
</button>

                    <div
                        class="profile absolute bottom-10 right-0 mt-2 w-64 bg-white dark:bg-gray-800 rounded-lg shadow-lg py-2 hidden group-hover:block z-50">
                        <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ auth()->guard('admin')->user()->name ?? 'Admin User' }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                {{ auth()->guard('admin')->user()->email }}
                            </div>
                            <div class="mt-2">
                                <span
                                    class="px-2 py-1 text-xs font-semibold rounded-full {{ auth()->guard('admin')->user()->role === 'super_admin' ? 'bg-purple-500/20 text-purple-400' : (auth()->guard('admin')->user()->role === 'admin' ? 'bg-blue-500/20 text-blue-400' : 'bg-yellow-500/20 text-yellow-400') }}">
                                    {{ ucfirst(str_replace('_', ' ', auth()->guard('admin')->user()->role)) }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('admin.password.change') }}"
                            class="w-full text-left block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <i class="fas fa-key mr-2"></i>
                            Change Password
                        </a>
                        <form method="POST" action="{{ route('admin.logout') }}" class="block">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
   <!-- Dock icons wrapper -->
    <div id="dockIcons" class="fixed bottom-6  flex items-center space-x-4 pointer-events-none px-4 py-3 rounded-2xl ml-2 transition-all duration-500">
           
        @foreach ($dockItems as $item)
        <div class="dock-icon relative flex flex-col items-center opacity-0 translate-x-10 transition-all duration-500 group">
            <!-- Label above icon -->
           <span class="icon-label">
    {{ $item['label'] }}
</span>

            <!-- Icon -->
            <a href="{{ $item['url'] }}" class="flex items-center justify-center">
                <i class="{{ $item['icon'] }} {{ $item['color'] }} text-3xl transform hover:scale-125 transition-transform duration-300 shadow-lg p-2 rounded-full"></i>
            </a>
        </div>
        @endforeach
    </div>

</div>

<script>
    const dockToggle = document.getElementById('dockToggle');
    const dockIcons = document.getElementById('dockIcons');
    const profileButton = document.getElementById('profile-button');

    dockToggle.addEventListener('click', () => {
        dockIcons.classList.toggle('show'); 
        profileButton.classList.toggle('show'); 

        if(dockIcons.classList.contains('show')){
            dockIcons.style.pointerEvents = 'auto';
            profileButton.style.pointerEvents = 'auto';
        } else {
            dockIcons.style.pointerEvents = 'none';
            profileButton.style.pointerEvents = 'none';
        }
    });
</script>
