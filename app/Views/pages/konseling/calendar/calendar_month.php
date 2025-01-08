<div class="h-full w-full">
    <div id="calendar" class="calendar-month overflow-auto w-full text-sm"></div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Element references
        const calendarElement = document.getElementById("calendar");
        const prevMonthBtn = document.getElementById("prevMonth");
        const nextMonthBtn = document.getElementById("nextMonth");
        const currentTime = document.getElementById('currentTime');
        const dateInput = document.getElementById("dateInput");
        const modal = Array.from(document.querySelectorAll(".modal"));
        const modalContent = Array.from(document.querySelectorAll(".modal-content"));
        const closeFormModal = Array.from(document.querySelectorAll(".close-modal"));

        // Date and Calendar setup
        const date = new Date();
        let currentMonth = date.getMonth();
        let currentYear = date.getFullYear();
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        const daysOfWeek = ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"];
        const jadwal = <?= json_encode($jadwal); ?> ?? [];


        function renderCalendar(month, year) {
            calendarElement.innerHTML = "";
            currentTime.textContent = `${monthNames[month]} ${year}`;

            const firstDay = new Date(year, month, 1);
            const totalDays = new Date(year, month + 1, 0).getDate();
            const startDay = firstDay.getDay();

            const calendarBody = document.createElement("div");
            calendarBody.classList.add("calendar-body");

            displayDaysOfWeek(calendarBody);
            displayEmptyDays(startDay, calendarBody);
            displayDates(month, year, totalDays, calendarBody);

            // Display empty day last.
            const totalCells = startDay + totalDays;
            const emptyCellToAdd = 42 - totalCells;
            displayEmptyDays(emptyCellToAdd, calendarBody);

            calendarElement.append(calendarBody);
        }

        function displayDaysOfWeek(calendarBody) {
            daysOfWeek.forEach((day) => {
                const dayEl = document.createElement("div");
                dayEl.classList.add("day");
                dayEl.textContent = day;
                calendarBody.append(dayEl);
            });
        }

        function displayEmptyDays(startDay, calendarBody) {
            for (let i = 0; i < startDay; i++) {
                const emptyEl = document.createElement("div");
                emptyEl.classList.add("empty");
                calendarBody.append(emptyEl);
            }
        }



        function displayDates(month, year, totalDays, calendarBody) {
            for (let day = 1; day <= totalDays; day++) {
                const dayEl = createDayElement(day, month, year);
                calendarBody.append(dayEl);
            }
        }

        function createDayElement(day, month, year) {
            const dayEl = document.createElement("div");
            dayEl.classList.add("date");

            if (isToday(day, month, year)) dayEl.classList.add("today");

            const jadwalHead = createJadwalHead(day, month, year, dayEl);
            dayEl.append(jadwalHead);
            highlightDate(day, month, year, dayEl);
            return dayEl;
        }

        function createJadwalHead(day, month, year, dayEl) {
            const jadwalHead = document.createElement('div');
            jadwalHead.classList.add('jadwal-head');
            const dayText = document.createElement("span");
            dayText.textContent = day;
            const overlayBtn = createOverlayButton();

            jadwalHead.append(dayText);

            if (isFutureOrToday(day, month, year) || dayEl.classList.contains('today')) {
                jadwalHead.append(overlayBtn);
                overlayBtn.addEventListener('click', event => {
                    if (document.querySelectorAll('.more-info')) {
                        document.querySelectorAll('.more-info').forEach(item => {
                            item.style.display = 'none';
                        });
                    }
                    dateInput.value = formatSelectedDate(year, month, day);
                    showModal(modal[0], modalContent[0], event);
                });
                closeModal(modal[0], modalContent[0], closeFormModal[0]);
                addHoverEffect(jadwalHead);
            }

            return jadwalHead;
        }

        function createOverlayButton() {
            const button = document.createElement("button");
            button.classList.add("modal-jadwal", "overlay");
            button.innerHTML = `
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 modal-jadwal">
                        <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                    </svg>`;

            return button;
        }



        function highlightDate(day, month, year, dayEl) {
            const selectedDate = formatSelectedDate(year, month, day);
            const dayJadwal = jadwal.filter(item => item.tanggal == selectedDate);

            if (dayJadwal.length > 0) {
                const jadwalBody = document.createElement('ul');
                jadwalBody.classList.add('jadwal-body');

                addJadwalItems(dayJadwal, jadwalBody);

                if (dayJadwal.length > 3) {
                    const moreInfo = createMoreInfo(dayJadwal, day, month, year);
                    const expandButton = createExpandButton(dayJadwal.length - 3, moreInfo);

                    jadwalBody.append(expandButton, moreInfo);
                }

                dayEl.append(jadwalBody);
            }
        }

        function addJadwalItems(dayJadwal, jadwalBody) {
            const contrastColors = {
                'Dijadwalkan': 'rgb(22 163 74)',
                'Selesai': 'rgb(220 38 38)',
                'Dibatalkan': 'rgb(75 85 99)',
            };

            dayJadwal.slice(0, 3).forEach(jadwalItem => {
                const jadwalInfo = createJadwalInfo(jadwalItem, contrastColors[jadwalItem.status]);
                jadwalBody.append(jadwalInfo);
            });
        }

        function createJadwalInfo(jadwalItem, backgroundColor) {
            // Jadwal info
            const jadwalInfo = document.createElement('li');
            jadwalInfo.classList.add('jadwal-info');
            jadwalInfo.style.backgroundColor = backgroundColor;

            // Student name
            const studentName = document.createElement('span');
            studentName.classList.add('jadwal-student');
            studentName.textContent = jadwalItem.nama_siswa;

            // Detail button
            const detailButton = document.createElement('a');
            detailButton.classList.add('jadwal-detail');
            detailButton.setAttribute('href', `<?= base_url(); ?>/jadwal/detail/${jadwalItem.hash_tanggal}?type=month`);
            detailButton.textContent = 'Detail';

            jadwalInfo.append(studentName, detailButton);

            return jadwalInfo;
        }

        function createMoreInfo(dayJadwal, day, month, year) {
            const moreInfo = document.createElement('div');
            moreInfo.classList.add('more-info');
            moreInfo.style.display = 'none';

            const header = createMoreInfoHeader(day, month, year);
            const moreInfoList = createMoreInfoList(dayJadwal);

            moreInfo.append(header, moreInfoList);
            return moreInfo;;
        }

        function createMoreInfoHeader(day, month, year) {
            const header = document.createElement('div');
            header.classList.add('header');

            const dateHeader = document.createElement('h2');
            dateHeader.classList.add('date-header');
            dateHeader.textContent = `${day} - ${monthNames[month]} - ${year}`;

            const closebBtn = createCloseButton();

            header.append(dateHeader, closebBtn);
            return header;
        }

        function createMoreInfoList(dayJadwal) {
            const contrastColors = {
                'Dijadwalkan': 'rgb(22 163 74)',
                'Selesai': 'rgb(220 38 38)',
                'Dibatalkan': 'rgb(75 85 99)',
            };

            const moreInfoList = document.createElement('ul');
            moreInfoList.classList.add('more-info-list');

            dayJadwal.forEach(jadwalItem => {
                const jadwalInfo = createJadwalInfo(jadwalItem, contrastColors[jadwalItem.status]);
                moreInfoList.append(jadwalInfo);
            });

            return moreInfoList;
        }

        function createCloseButton() {
            const closebBtn = document.createElement('div');
            closebBtn.classList.add('close-button');
            closebBtn.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5">
                                <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                `;
            closebBtn.style.cursor = 'pointer';

            const closeMoreInfo = () => {
                const moreInfo = closebBtn.closest('.more-info');
                if (moreInfo) {
                    moreInfo.style.display = 'none';
                }
            };

            closebBtn.addEventListener('click', (event) => {
                event.stopPropagation();
                closeMoreInfo();
            });

            document.addEventListener('click', (event) => {
                event.stopPropagation();
                const moreInfo = closebBtn.closest('.more-info');
                if (moreInfo && !moreInfo.contains(event.target)) {
                    closeMoreInfo();
                }
            });

            return closebBtn;
        }

        function createExpandButton(extracCount, moreInfo) {
            const expandButton = document.createElement('button');
            expandButton.classList.add('expand-more');
            expandButton.textContent = `+${extracCount} More`;

            expandButton.addEventListener('click', (event) => {
                event.stopPropagation();
                
                if (document.querySelectorAll('.more-info')) {
                    document.querySelectorAll('.more-info').forEach(item => {
                        item.style.display = 'none';
                    });
                }

                const dateElement = event.target;
                const dateRect = dateElement.getBoundingClientRect();
                const calendarRect = dateElement.closest('.calendar-body').getBoundingClientRect();

                moreInfo.style.top = `0`;
                moreInfo.style.display = "block";

                if (dateRect.left < calendarRect.left + calendarRect.width / 3) {
                    moreInfo.style.left = `0`;
                } else if (dateRect.left > (calendarRect.left + (calendarRect.width / 3) * 2)) {
                    moreInfo.style.right = `0`;
                } else {
                    moreInfo.style.left = '50%';
                    moreInfo.style.transform = "translateX(-50%)";
                }
            });

            return expandButton;
        }



        function isFutureOrToday(day, month, year) {
            return new Date(year, month, day) >= new Date();
        }

        function isToday(day, month, year) {
            const today = new Date();
            return day == today.getDate() && month == today.getMonth() && year == today.getFullYear();
        }

        function formatSelectedDate(year, month, day) {
            return `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
        }

        function addHoverEffect(element) {
            element.addEventListener("mouseover", () => {
                element.style.background = 'linear-gradient(160deg, #ff147f, #8624c2)';
                element.style.color = '#fff';
            });
            element.addEventListener("mouseout", () => {
                element.style.background = '';
                element.style.color = '';
            });
        }


        prevMonthBtn.addEventListener("click", () => {
            currentMonth--;
            if (currentMonth < 0) {
                currentMonth = 11;
                currentYear--;
            }
            renderCalendar(currentMonth, currentYear);
        });

        nextMonthBtn.addEventListener("click", () => {
            currentMonth++;
            if (currentMonth > 11) {
                currentMonth = 0;
                currentYear++;
            }
            renderCalendar(currentMonth, currentYear);
        });

        renderCalendar(currentMonth, currentYear);

        // To display modal details
        <?php if (isset($ModalDetailActive) && $ModalDetailActive) : ?>
            window.onload = function(e) {
                showModal(modal[2], modalContent[2]);
                closeModal(modal[2], modalContent[2], closeFormModal[1]);
                window.history.replaceState(null, null, '/jadwal');
            }
        <?php endif; ?>
    });
</script>