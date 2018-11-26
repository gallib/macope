<nav class="col-md-3 col-lg-2">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-home"></i> Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('expenses.index') }}">
                <i class="fas fa-fw fa-sort-amount-down"></i> Expenses
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('incomes.index') }}">
                <i class="fas fa-fw fa-sort-amount-up"></i> Incomes
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('journal.index') }}">
                <i class="fas fa-fw fa-clipboard-list"></i> Journal
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('import-file.index') }}">
                <i class="fas fa-fw fa-file-import"></i> Import file
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('accounts.index') }}">
                <i class="fas fa-fw fa-folder"></i> Accounts
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.index') }}">
                <i class="fas fa-fw fa-tag"></i> Categories
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('type-categories.index') }}">
                <i class="fas fa-fw fa-tags"></i> Type Categories
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('categorizations.index') }}">
                <i class="fas fa-fw fa-book"></i> Categorizations
            </a>
        </li>
    </ul>
</nav>
