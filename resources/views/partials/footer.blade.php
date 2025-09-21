<footer class="bg-dark text-light text-center py-3 mt-5">
    <p class="mb-0">
        &copy; {{ date('Y') }} {{ $globalSetting->site_name ?? 'NewsPortal' }} |
        {{ $globalSetting->email ?? 'info@example.com' }} |
        {{ $globalSetting->phone ?? '' }} |
        {{ $globalSetting->address ?? '' }}
    </p>
</footer>