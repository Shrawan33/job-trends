<ul id="progressbar" class="m-0 p-0">
    <li class="@if ($step<=4) active @endif">
        <span class="number">
            <span class="digit">1</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12"
                fill="none" class="finish_arrow">
                <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
        <p>Basic Information</p>
    </li>
    <li class="@if ($step<=4 && $step >= 2) active @endif">
        <span class="number">
            <span class="digit">2</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12"
                fill="none" class="finish_arrow">
                <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
        <p>Profile Summary</p>
    </li>
    <li class="@if ($step<=4 && $step >= 3) active @endif">
        <span class="number">
            <span class="digit">3</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12"
                fill="none" class="finish_arrow">
                <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
        <p>Profession Experience</p>
    </li>
    <li class="@if ($step >= 4) active @endif">
        <span class="number">
            <span class="digit">4</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="12" viewBox="0 0 16 12"
                fill="none" class="finish_arrow">
                <path d="M14.6654 1L5.4987 10.1667L1.33203 6" stroke="white" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
        <p>Other Information</p>
    </li>
</ul>
