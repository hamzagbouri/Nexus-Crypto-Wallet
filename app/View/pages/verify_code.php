<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification de code</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center bg-[#0d102c] font-['Poppins']">
    <div class="w-full max-w-md p-8">
        <form action="/nexus-crypto-wallet/Auth/verify_code/<?= $data ?>" method="POST" class="space-y-6">
            <div class="relative">
                <input 
                    type="text" 
                    name="code" 
                    required 
                    placeholder="Entrez le code"
                    class="w-full px-6 py-3 bg-transparent border-2 border-white rounded-[50px] text-white placeholder-gray-300 text-lg focus:outline-none focus:border-[#3d51f2] transition-colors"
                >
            </div>
            <button 
                type="submit"
                class="w-full px-6 py-3 bg-[#3d51f2] hover:bg-[#5670ef] text-white font-bold rounded-[50px] transition-colors"
            >
                Vérifier
            </button>
        </form>
    </div>
</body>
</html>