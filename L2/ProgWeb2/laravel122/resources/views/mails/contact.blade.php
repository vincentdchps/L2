<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Nouveau message de contact</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333; line-height: 1.6;">

    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h2 style="color: #2d3748; border-bottom: 2px solid #edf2f7; padding-bottom: 10px;">
            Nouvelle demande de contact
        </h2>
        
        <p><strong>Expéditeur :</strong> {{ $contact['name'] }}</p>
        <p><strong>Sujet :</strong> {{ $contact['title'] }}</p>
        
        <div style="background-color: #f7fafc; padding: 15px; border-radius: 5px; margin-top: 20px;">
            <h4 style="margin-top: 0; color: #4a5568;">Message :</h4>
            <p>{!! nl2br(e($contact['content'])) !!}</p>
        </div>

        <p style="margin-top: 30px; font-size: 0.9em; color: #718096;">
            Cet email a été généré automatiquement depuis l'application.
        </p>
    </div>

</body>
</html>