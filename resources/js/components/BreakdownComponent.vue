<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div id="container">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMin slice" viewBox="0 0 728 400">
                    <!--Background-->
                    <path d="M0 0h728v400H0z" fill="#fff"/>
                    <!--Spiral path-->
                    <defs>
                      <path id="s" d="m351 487c0 8-11 4-14-1-6-11 4-24 15-27 19-5 37 11 40 30 4 27-18 50-44 53-35 4-64-25-66-59-3-42 32-77 73-79 50-3 90 39 92 88 2 57-46 104-102 105-65 2-117-53-119-117-1-72 60-131 131-132 80-1 144 67 145 146 1 87-74 158-160 158-95 0-171-81-171-175 0-102 88-185 190-184 110 1 198 95 197 204C557 615 456 709 340 708 215 706 115 598 117 475 119 342 233 236 364 238 504 240 616 361 614 500 611 648 484 766 337 763 182 760 58 626 61 472 65 309 206 179 367 183c170 4 306 151 302 320-4 178-158 319-335 315" />
                    </defs>
                    <!--Text & link to path-->
                    <text font-family="monospace" font-size="20" fill="#1d1f20">
                    <textPath id="text" xlink:href="#s">@{{ breakdowns }}</textPath>
                    </text>
                  </svg>
                </div>
            </div>
        </div>
    </div>
</template>

<style type="text/css">

    body{
      background-color:#fff;
    }
    body, html {
      height: 100%;
      width: 100%;
      margin: 0;
      padding: 0;
    }

    /* Demo container*/
    #container{
      max-width:900px;
      width:100%;
      overflow:hidden;
      position: absolute;
      left: 50%;
      margin-right: -50%;
      margin-top: 35%;
      transform: translate(-50%, -50%);
    }

    /* Bottom hack for IE*/
    svg{
      width:100%;
      padding-bottom: 115.55%;
      height: 1px;
      overflow: visible;
     }

</style>

<script>
    export default {
        data() {
            return {
                breakdowns: ''
            }
        },
        mounted() {
            console.log('Component mounted.')
            this.getBreakdowns();
        },
        methods: {
            getBreakdowns: function() {
                axios.get('show')
                .then((response) => {

                    let resp = response.data.toString();

                    this.breakdowns = resp.replaceAll(',',' ');
                    console.log(resp);
                })
                .catch((error) => {
                    console.log(error);
                })
            }
        }
    }
</script>
