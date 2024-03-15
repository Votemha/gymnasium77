
    </div>
    <!-- новости -->
    <div class="news">
    
    </div>
    
</div>

<script>
                        const styled = document.querySelector("#styled")
                        const root = document.querySelector(":root")
                        var results = document.cookie.match(/theme=(.+?)(;|$)/)
                        function hasCookie(name) {
                            return document.cookie.split(';').some(c => c.trim().startsWith(name + '='));
                        }
                        let i = 0
                        if (hasCookie('theme')) {
                            if (results[1] == 'white'){
                                // белый цвет
                                root.style.setProperty('--bg-color', '#E6ECF2')
                                root.style.setProperty('--prop-color', '#FFFFFF')
                                root.style.setProperty('--accent-color', '#D9D9D9')
                                root.style.setProperty('--text-color', '#000000')
                                root.style.setProperty('--accent2-color', '#B3B3B3')
                                root.style.setProperty('--navMobileBg-color', '#B8BEC3')
                                root.style.setProperty('--navMobileAccent-color', '#CECECE')
                                root.style.setProperty('--opacityImg', '0.5')
                            } else {
                                // темный
                                root.style.setProperty('--bg-color', '#212121')
                                root.style.setProperty('--prop-color', '#444444')
                                root.style.setProperty('--accent-color', '#2D2D2D')
                                root.style.setProperty('--text-color', '#FFFFFF')
                                root.style.setProperty('--accent2-color', '#444444')
                                root.style.setProperty('--navMobileBg-color', '#444444')
                                root.style.setProperty('--navMobileAccent-color', '#343434')
                                root.style.setProperty('--opacityImg', '1')
                            }
                            if (results[1] == 'white') {
                                i = 0
                            } else {
                                i = 1
                            }
                        } 
                        styled.addEventListener("click", function(e) {
                            if (i % 2 == 0) {
                                // тёмный
                                root.style.setProperty('--bg-color', '#212121')
                                root.style.setProperty('--prop-color', '#444444')
                                root.style.setProperty('--accent-color', '#2D2D2D')
                                root.style.setProperty('--text-color', '#FFFFFF')
                                root.style.setProperty('--accent2-color', '#444444')
                                root.style.setProperty('--navMobileBg-color', '#444444')
                                root.style.setProperty('--navMobileAccent-color', '#343434')
                                root.style.setProperty('--opacityImg', '1')
                                document.cookie = "theme=black; path=/"; 
                            } else {
                                // белый
                                root.style.setProperty('--bg-color', '#E6ECF2')
                                root.style.setProperty('--prop-color', '#FFFFFF')
                                root.style.setProperty('--accent-color', '#D9D9D9')
                                root.style.setProperty('--text-color', '#000000')
                                root.style.setProperty('--accent2-color', '#B3B3B3')
                                root.style.setProperty('--navMobileBg-color', '#B8BEC3')
                                root.style.setProperty('--navMobileAccent-color', '#CECECE')
                                root.style.setProperty('--opacityImg', '0.5')
                                document.cookie = "theme=white; path=/";
                            }
                            ++i
                        })
                    </script>