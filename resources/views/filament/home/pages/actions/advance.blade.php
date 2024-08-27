<div style="padding: 16px; background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
    <center>
        <div style="font-size: 1.125rem; font-weight: 600; color: #2d3748;">
            {{ $record->users->name }}
        </div>
        <div style="margin-top: 8px;">
            <a href="{{ $record->url }}" target="_blank" style="color: #3182ce; text-decoration: none;"
                onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';">
                {{ $record->url }}
            </a>
        </div>
        <div style="margin-top: 16px; color: #718096;">
            {{ $record->query }}
        </div>
    </center>
</div>
