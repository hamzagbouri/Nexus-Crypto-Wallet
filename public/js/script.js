
    const url = "http://localhost/Nexus-crypto-wallet/api/get";

    fetch(url)
        .then(response => response.json())
        .then(data => {
            const coins = data.data.slice(0, 10); // Get top 10
            const tbody = document.querySelector(".crypto-table tbody");
            tbody.innerHTML = ""; // Clear existing rows

            coins.forEach(coin => {
                const price = coin.quote.USD.price.toFixed(2);
                const change24h = coin.quote.USD.percent_change_24h.toFixed(2);
                const marketCap = coin.quote.USD.market_cap.toLocaleString();
                const volume24h = coin.quote.USD.volume_24h.toLocaleString();
                const circulatingSupply = coin.circulating_supply.toLocaleString();
                const totalSupply = coin.total_supply ? coin.total_supply.toLocaleString() : "N/A";
                const priceClass = change24h >= 0 ? "up" : "down";

                const row = `
          <tr>
            <td>${coin.cmc_rank}</td>
            <td>${coin.name} (${coin.symbol})</td>
            <td class="${priceClass}">$${price}</td>
            <td class="${priceClass}">${change24h}%</td>
            <td><img src="../img/chart-placeholder.png" alt="${coin.name} Chart" /></td>
            <td>
              <i class="fa fa-star"></i>
              <i class="fa fa-info-circle"></i>
            </td>
          </tr>
        `;
                tbody.innerHTML += row;
            });
        })
        .catch(error => console.error("Error fetching crypto data:", error));
