#include<iostream>
using namespace std;
long result( int a[], int f, int s, int l, int k )
{	long res=0;
	int ch=0;
	for( long i=s;i>=f;i-- )
	{	for( long j=i+1; j<=l; j++ )
		{	if( a[i]%a[j]==k )
			{	res+=(i-f)*(l-j)+(i-f)+(l-j)+1;
				res+=result(a,f,i-1,j-1,k);
				ch=1;
			}
			if( ch==1 )
				break;
		}
		if( ch==1 )
			break;
	}
	return res;
}
int main()
{
	long n,k;
	cin>>n>>k;
	int a[n];
	for(int i=0;i<n;i++)
		cin>>a[i];
	cout<<(n*(n+1)/2)-result(a,0,n-2,n-1,k);
	return 0;
}
