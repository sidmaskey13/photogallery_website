<footer>
    <div class="row">
        <div class="col-md-4">
            <div class="footer-box">
                <a target="_blank" href="https://plus.google.com/117053107002335195220"><i
                            class="fa fa-google-plus"></i></a>
                <a target="_blank" href="https://www.facebook.com/nepaltourismboard"><i class="fa fa-facebook"></i></a>
                <a target="_blank" href="https://www.youtube.com/channel/UC2SJQgLtP-whF6M4K_m7XAA"><i
                            class="fa fa-youtube"></i></a>
            </div>
        </div>


        <div class="col-md-4"></div>

        <div class="col-md-4">
            <div class="footer-box">
                <div class="row">
                    <div class="col-md-4">
                        <div id="myBtn_10000000" onclick="showModal(10000000)" style="cursor: pointer;">About Us</div>
                    </div>
                    <div class="col-md-4">
                        <div id="myBtn_10000001" onclick="showModal(10000001)" style="cursor: pointer;">Contact Us</div>
                    </div>
                    <div class="col-md-4">
                        <div id="myBtn_10000002" onclick="showModal(10000002)" style="cursor: pointer;">Disclaimer</div>
                    </div>
                </div>
                <p>© 2019. Nepal Tourism Board. All Rights Reserved. </p>


            </div>
            <div id="myModal_10000000" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>About Us</h5>
                        <span class="close" onclick="closeModal(10000000)">&times;</span>
                    </div>
                    <div class="modal-body">
                        <p> Nepal Tourism Board is a national tourism organization of Nepal established in 1998 by an
                            Act of
                            Parliament in the form of partnership between the Government of Nepal and private sector
                            tourism
                            industry to develop and market Nepal as an attractive tourist destination. The Board
                            provides platform
                            for vision-drawn leadership for Nepal’s tourism sector by integrating Government commitment
                            with the
                            dynamism of private sector.
                            NTB is promoting Nepal in the domestic and international market and is working toward
                            positioning the
                            image of the country. It also aims to regulate product development activities. Fund for NTB
                            is collected
                            in the form of Tourist Service Fee from departing foreign passengers at the Tribhuvan
                            International
                            Airport, Kathmandu, thus keeping it financially independent. The Board chaired by the
                            Secretary at the
                            Ministry of Tourism and Civil Aviation consists of 11 Board Members with five Government
                            representatives, five private sector representatives and the Chief Executive Officer.
                            “Naturally Nepal, Once is not Enough” is the tourism brand of Nepal.”Naturally Nepal” is a
                            simple
                            expression that repackages the Nepal brand in a positive light. “Once is not Enough” not
                            only accurately
                            captures the tourists' emotions at the airport’s departure gate but also serves as a
                            decision tool that
                            enables the Nepali tourism industry individually and collectively to focus both on consumer
                            retention
                            and acquisition.
                        </p>
                    </div>
                </div>
            </div>

            <div id="myModal_10000001" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5> Contact Us</h5>
                        <span class="close" onclick="closeModal(10000001)">&times;</span>
                    </div>
                    <div class="modal-body">
                        <h3><strong>Nepal Tourism Board</strong></h3>
                        <h4>Tourist Service Center</h4>
                        <h5>Address: Bhrikutimandap, Kathmandu<br/>
                            P.O. Box: 11018<br/>
                            Tel: +977 1 4256909<br/>
                            Fax: +977 1 4256910<br/>
                            E-mail: info@ntb.org.np</h5>
                        <h5>For trade and industry activities visit our <a href="http://trade.welcomenepal.com/"
                                                                           target="_blank">corporate website</a></h5>
                        <h5>For participation in Fairs/Sales Mission and Tender/Quotation, please <a
                                    href="http://tenders.welcomenepal.com/" target="_blank"
                                    title="Trade Fairs and Tenders | Nepal Tourism Board">click here</a></h5>
                    </div>
                </div>
            </div>

            <div id="myModal_10000002" class="modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Disclaimer</h5>
                        <span class="close" onclick="closeModal(10000002)">&times;</span>
                    </div>
                    <div class="modal-body">
                        <p>Every effort has been made to ensure accuracy and reliability of the content. In case of
                            lapses and discrepancies, revisions and updates will be made. Therefore, we request you to
                            approach us via e-mail, social media, phone or in person, for suggestions on revisions and
                            updates where necessary. Thank you for support!</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <script>
        function showModal(id) {
            var modal = document.getElementById('myModal_' + id);
            modal.style.display = "block";
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        }

        function closeModal(id) {
            var modal = document.getElementById('myModal_' + id);
            var span = document.getElementsByClassName("close")[0];
            modal.style.display = "none";
        }
    </script>
</footer>