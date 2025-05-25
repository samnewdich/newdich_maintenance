<?php
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/head.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/left.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/public/events/history-top-body.php");
?>




                  <div class="tab-content tab-content-basic">
                    <h3>Credit History</h3>
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                      <div class="row">
                        <div class="col-sm-12">
                          <!--<div class="statistics-details d-flex align-items-center justify-content-between" style="display:flex; flex-wrap:wrap;">-->

                          <?php
                          include($_SERVER["DOCUMENT_ROOT"]."/Events/Query/QEvents.php");

                          $searchdata = trim(htmlspecialchars($_GET["searchdata"])) ? trim(htmlspecialchars($_GET["searchdata"])) : '';
                          $pageNumberSearch = trim(htmlspecialchars($_GET["page_number"])) ? trim(htmlspecialchars($_GET["page_number"])) : 50;
                          $currentPageSearch = trim(htmlspecialchars($_GET["current_page"])) ? trim(htmlspecialchars($_GET["current_page"])) : 0;
                          $startFrom = trim(htmlspecialchars($_GET["startfrom"])) ? trim(htmlspecialchars($_GET["startfrom"])) : '';
                          $endTo = trim(htmlspecialchars($_GET["endto"])) ? trim(htmlspecialchars($_GET["endto"])) : '';
                          $transaction_type = trim(htmlspecialchars($_GET["transaction_type"])) ? trim(htmlspecialchars($_GET["transaction_type"])) : 'credit';

                          $pageNumberSearch = (int) $pageNumberSearch;
                          $currentPageSearch = (int) $currentPageSearch;
                          $currentPageSearchDisplay = $currentPageSearch + 1;
                          
                          $allAirtime;
                          if(isset($_GET["currentpage"])){
                            $cpage = (int) trim(htmlspecialchars($_GET["currentpage"]));
                            $allAirtime = json_decode($newQEvent->getEventsSearch($searchdata, $transaction_type, $startFrom, $endTo, $cpage, $pageNumberSearch), true);
                          }
                          elseif(isset($_GET["current_page"])){
                            $cpage = (int) trim(htmlspecialchars($_GET["current_page"]));
                            $allAirtime = json_decode($newQEvent->getEventsSearch($searchdata, $transaction_type, $startFrom, $endTo, $cpage, $pageNumberSearch), true);
                          }
                          else{
                            $cpage = $currentPageSearch;
                            $allAirtime = json_decode($newQEvent->getEventsSearch($searchdata, $transaction_type, $startFrom, $endTo, $cpage, $pageNumberSearch), true);
                          }

                          include("history-results.php");
    
                          ?>

                          <hr />



                        </div>



                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Developed & Maintained By <a href="https://www.newdich.tech/" target="_blank">Newdich Technology</a></span>
              <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2024. All rights reserved.</span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->




<?php
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/public/events/history-bottom-body.php");
include($_SERVER["DOCUMENT_ROOT"]."/admin-gui/ui/footer.php");
?>